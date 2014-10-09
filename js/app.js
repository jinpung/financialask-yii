(function () {

	'use strict';

	var faApp = angular.module('faApp', [
		'iso.directives',
		'infinite-scroll'
	]);

	angular.module('infinite-scroll').value('THROTTLE_MILLISECONDS', 1000);

	/**
	 * Main App Controller
	 */
	faApp.controller('MainController', [
		'$scope',
		function ($scope) {

			// Sidebar status
			$scope.collapsed = true;

			$scope.$watch('windowWidth', function (newVal, oldVal) {
				if (oldVal == undefined && newVal < 768) {
					$scope.collapsed = true;
					return;
				}

				// Resized to small
				if (!$scope.collapsed && (oldVal > 767) && (newVal < 768)) {
					$scope.collapsed = false;

					// Resized to big
				} else if ((oldVal <= 767) && (newVal > 767)) {
					$scope.collapsed = true;
				}
			})

			$scope.over = function () {
				// Only applies on desktop size
				if ($scope.windowWidth > 767)
					$scope.collapsed = false;
			}

			$scope.leave = function () {
				// Only applies on desktop size
				if ($scope.windowWidth > 767) {
					$('.cl-sidebar').scrollTop(0);
					$scope.collapsed = true;
				}
			}

			$scope.showYou = function () {
				$scope.collapsed = !$scope.collapsed;
			}


		}]);

	/**
	 * Feeds Page
	 */
	faApp.controller('ActivitiesController', [
		'$scope', '$window', 'dataFactory',
		function ($scope, $window, dataFactory) {
			var min_feed_id = 0;
			var max_feed_id = 0;
			var disabled = false;
			$scope.feeds = [];
			$scope.loading = false;

			$scope.maincont = angular.element('#pcont');

			$scope.isDisabled = function () {
				return $scope.loading || disabled;
			}

			/**
			 * Cannot apply directly using $container.isotope('on', 'layoutComplete', function)
			 * From the angular-isotope source there is a 'isotope.onLayout' event which provides similar event.;
			 */
			$scope.$on('isotope.onLayout', function (isoInstance, laidOutItems) {
				$scope.loading = false;
			});

			$scope.load = function () {
				if ($scope.loading) return;
				$scope.loading = true;

				dataFactory.getActivities(min_feed_id)
					.success(function (dataPacket) {
						var old_min_feed_id = min_feed_id;

            // overwrite the current user data
            var activities = dataPacket.activities;
            $scope.user = dataPacket.user;

						if (activities.length == 0) {
							disabled = true;
              $scope.loading = false;
						} else {
							for (var i = 0; i < activities.length; i++) {
                var activity = activities[i];
                var type = activity.type;
                if(type == "answer"){
                  activities[i].answer.userAgreed = false;
                  if(!dataPacket.user.isGuest) for(var aID = 0;  aID < activity.answer.agreement.length; aID++){
                    if(activity.answer.agreement[aID].id == dataPacket.user.id){
                      activity.answer.userAgreed = true;
                      break;
                    }  
                  }
                }
								$scope.feeds.push(activities[i]);
              
								if (min_feed_id == 0) min_feed_id = activities[i].id;
								else min_feed_id = Math.min(min_feed_id, activities[i].id);
							}
						}

						console.log("DONE: loadActivities(" + old_min_feed_id + ")");

						//$scope.loading = false;
					})
					.error(function (error) {
						console.log('ERROR getting activities: ' + error);
						$scope.loading = false;
					});
			};

			$scope.tpl = function (type) {
				return '/activity/page/' + type;
			};

      $scope.clickThank = function(user, answer){
        if(user.isGuest) $window.location.href = '/site/login';
        else{
          answer.thanks.userThanked = !answer.thanks.userThanked;
          dataFactory.thankResponse(answer);
        } 
      }

      $scope.clickAgree = function(user, answer){
        answer.userAgreed = !answer.userAgreed;
        dataFactory.agreeResponse(user, answer);
        setTimeout(function(){$scope.refreshIso();}, 250);
      }

			$scope.load();
		}
	]);


    faApp.factory('dataFactory', [
        '$http', function($http) {
            var factory = {};
            var baseActivitiesUrl = '/activity/json';

            factory.getActivities = function(before_id) {
                var url = baseActivitiesUrl;
                if (before_id > 0)
                    url += '?before_id=' + before_id;
                return $http.get(url);
            };

            factory.thankResponse = function(answer) {
                $http.post('/questionResponseThanks/thank/' + answer.id).success(function(data, status, headers, config) {
                    // Do nothing - for debug purposes.
                }).error(function(data, status, headers, config) {
                    answer.thanks.userThanked = !answer.thanks.userThanked;
                });
            }
            factory.agreeResponse = function(user, answer) {
                $http.post('/question_agree/agree/' + answer.id).success(function(data, status, headers, config) {
                    if (data.result == "deleted") {
                        for (var i = 0; answer.agreement && i < answer.agreement.length; i++) {
                            if (answer.agreement[i].id == user.id) {
                                answer.agreement.splice(i, 1);
                                break;
                            }
                        }
                    } else {
                        if (answer.agreement == undefined)
                            answer.agreement = [user];
                        else
                            answer.agreement.push(user);
                    }

                }).error(function(data, status, headers, config) {
                    answer.userAgreed = !answer.userAgreed;
                });
            }

            return factory;
        }
    ]);

    /**
     * Resize directive
     * src: http://jsfiddle.net/jaredwilli/SfJ8c/
     */
    faApp.directive('resize', function($window) {
        return function(scope, element) {
            var w = angular.element($window);
            scope.getWindowDimensions = function() {
                return {
                    'h': w.height(),
                    'w': w.width()
                };
            };
            scope.$watch(scope.getWindowDimensions, function(newValue, oldValue) {
                scope.windowHeight = newValue.h;
                scope.windowWidth = newValue.w;

                scope.style = function() {
                    return {
                        'height': (newValue.h - 100) + 'px',
                        'width': (newValue.w - 100) + 'px'
                    };
                };

            }, true);


            w.bind('resize', function() {
                scope.$apply();
            });
        }
    });
})();
