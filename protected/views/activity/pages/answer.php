<div class="feed-item-author clearfix">
    <a class="another-source" target="_blank" ng-if="feed.answer.refURL.length > 0" href="{{ feed.answer.refURL }}">External content</a>
	<div class="avatar left"
	     style="background-image: url({{feed.answer.user.avatarUrl||'/img/default-avatar.png'}})"></div>
	<div class="caduceus left"></div>
	<div class="feed-header-text">
		<a class="author-name" href="/profile/{{feed.answer.user.id}}">
			{{feed.answer.user.name||'A adviser'}}
		</a>
    <span>answered:</span>
	</div>
</div>

<div class="feed-item-content">
	<div class="answer-icon"></div>
	<a class="question" href="/questions/{{feed.question.id}}">
		{{ feed.question.content }}
	</a>
	<span class="in-brief">In brief:
        <span class="short-answer">
            {{ feed.answer.brief}}
        </span>            
    </span>


	<!--<div class="long-answer">
		{{ feed.answer.summary}}
	</div>-->
	<a class="answer-img" href="/questions/{{feed.question.id}}" ng-style="{'background-image': 'url('+feed.answer.imgUrl+')'}"></a>

	<div class="long-answer">
    <span class="answer-text">{{ feed.answer.content }}</span>
    <!--<a class="see-more-link" href="/questions/{{feed.question.id}}">See more</a>-->
  </div>

  <a class="thank-btn btn" ng-click="clickThank(user, feed.answer)" ng-if="user.type != '<?= User::TYPE_ADVISER ?>'" ng-disabled="feed.answer.thanks.userThanked">
      {{ feed.answer.thanks.userThanked  && 'Thanked!' || 'Thank'}}
  </a>
  <a class="thank-btn btn" ng-click="clickAgree(user, feed.answer)" ng-if="user.type == '<?= User::TYPE_ADVISER ?>'">
      {{ feed.answer.userAgreed && 'Agreed!' || 'Agree' }}
  </a>

</div>

<div class="answer-agrees answer-list-el agrees-link" ng-if="feed.answer.agreement.length">
	<div class="caduceus-icon"></div>
  <span class="small-faces" ng-repeat="adviser in feed.answer.agreement" style="background-image: url({{adviser.avatarUrl||'/img/default-avatar.png'}})"></span>				
	<a class="agrees">{{feed.answer.agreement.length}} advisors</a>
	agree
</div> 
