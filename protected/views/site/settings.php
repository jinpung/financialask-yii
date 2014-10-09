<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
?>
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/style/css/default/sprites.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/style/css/default/settings.css"/>
<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/settings.js"></script>


<div class="settings-container">
<div class="left-panel">
<div class="settings-item notification closed">
<div class="settings-header clearfix">
	<div class="header-img sprite-icon bell-small"></div>
	<div class="header-text">Notification Settings</div>
	<div class="header-arrow down-arrow"></div>
</div>
<div class="settings-content">
<div class="setting-title clearfix">
	<div class="title-text">
		Your Questions
	</div>
	<div class="push">
		<div class="sprite-icon phone-small"></div>
		<br/>
		Push
	</div>
	<div class="email">
		<div class="sprite-icon mail-small"></div>
		<br/>
		Email
	</div>
</div>
<div class="setting-list">
	<div class="setting-item clearfix">
		<div class="setting-text">
			An adviser answers your question
		</div>
		<div class="push off" data-id="your_question_received_answer">
			<div class="sprite-icon circle"></div>
		</div>
		<div class="email on" data-id="your_question_received_answer">
			<div class="sprite-icon circle-active"></div>
		</div>
	</div>

	<div class="setting-item clearfix">
		<div class="setting-text">
			An adviser agrees or comments on an answer to your question
		</div>
		<div class="push on" data-id="your_answer_commented">
			<div class="sprite-icon circle-active"></div>
		</div>
		<div class="email on" data-id="your_answer_commented">
			<div class="sprite-icon circle-active"></div>
		</div>
	</div>

	<div class="setting-item clearfix">
		<div class="setting-text">
			An adviser answers a question you follow
		</div>
		<div class="push on" data-id="followed_question_answered">
			<div class="sprite-icon circle-active"></div>
		</div>
		<div class="email on" data-id="followed_question_answered">
			<div class="sprite-icon circle-active"></div>
		</div>
	</div>

	<div class="setting-item clearfix">
		<div class="setting-text">
			An adviser agrees or comments on an answer to a question you follow
		</div>
		<div class="push on" data-id="followed_answer_commented">
			<div class="sprite-icon circle-active"></div>
		</div>
		<div class="email on" data-id="followed_answer_commented">
			<div class="sprite-icon circle-active"></div>
		</div>
	</div>
</div>

<div class="setting-title clearfix">
	<div class="title-text">
		Your Conferences
	</div>
	<div class="push">
		<div class="sprite-icon phone-small"></div>
		<br/>
		Push
	</div>
	<div class="email">
		<div class="sprite-icon mail-small"></div>
		<br/>
		Email
	</div>
</div>
<div class="setting-list">
	<div class="setting-item clearfix">
		<div class="setting-text">
			An adviser responds to Virtual Consult
		</div>
		<div class="push on" data-id="direct_message_received">
			<div class="sprite-icon circle-active"></div>
		</div>
		<div class="email on" data-id="direct_message_received">
			<div class="sprite-icon circle-active"></div>
		</div>
	</div>
</div>

<div class="setting-title clearfix">
	<div class="title-text">
		Your Checklists
	</div>
	<div class="push">
		<div class="sprite-icon phone-small"></div>
		<br/>
		Push
	</div>
	<div class="email">
		<div class="sprite-icon mail-small"></div>
		<br/>
		Email
	</div>
</div>
<div class="setting-list">
	<div class="setting-item clearfix">
		<div class="setting-text">
			Reminders for actions on your to do list
		</div>
		<div class="push on" data-id="member_action_reminder">
			<div class="sprite-icon circle-active"></div>
		</div>
		<div class="email on" data-id="member_action_reminder">
			<div class="sprite-icon circle-active"></div>
		</div>
	</div>
</div>
<!--
                <div class="setting-title clearfix">
                    <div class="title-text">
                        Doctor Content for You
                    </div>
                    <div class="push">
                        <div class="sprite-icon phone-small"></div>
                        <br/>
                        Push
                    </div>
                    <div class="email">
                        <div class="sprite-icon mail-small"></div>
                        <br/>
                        Email
                    </div>
                </div>
                <div class="setting-list">
                    <div class="setting-item clearfix">
                        <div class="setting-text">
                            Tips
                        </div>
                        <div class="push on" data-id="member_content_share_tip">
                            <div class="sprite-icon circle-active"></div>
                        </div>
                        <div class="email on" data-id="member_content_share_tip">
                            <div class="sprite-icon circle-active"></div>
                        </div>
                    </div>

                    <div class="setting-item clearfix">
                        <div class="setting-text">
                            Answers
                        </div>
                        <div class="push on" data-id="member_content_share_user_answer">
                            <div class="sprite-icon circle-active"></div>
                        </div>
                        <div class="email on" data-id="member_content_share_user_answer">
                        </div>
                    </div>


                    <div class="setting-item clearfix">
                        <div class="setting-text">
                            News
                        </div>
                        <div class="push on" data-id="member_content_share_news_item">
                            <div class="sprite-icon circle-active"></div>
                        </div>
                        <div class="email on" data-id="member_content_share_news_item">
                        </div>
                    </div>


                    <div class="setting-item clearfix">
                        <div class="setting-text">
                            Apps
                        </div>
                        <div class="push on" data-id="member_content_share_reviewable_app">
                            <div class="sprite-icon circle-active"></div>
                        </div>
                        <div class="email on" data-id="member_content_share_reviewable_app">
                        </div>
                    </div>


                    <div class="setting-item clearfix">
                        <div class="setting-text">
                            Checklists
                        </div>
                        <div class="push on" data-id="member_content_share_checklist">
                            <div class="sprite-icon circle-active"></div>
                        </div>
                        <div class="email on" data-id="member_content_share_checklist">
                        </div>
                    </div>


                    <div class="setting-item clearfix">
                        <div class="setting-text">
                            Topics
                        </div>
                        <div class="push on" data-id="member_content_share_topic">
                            <div class="sprite-icon circle-active"></div>
                        </div>
                        <div class="email on" data-id="member_content_share_topic">
                        </div>
                    </div>


                    <div class="setting-item clearfix">
                        <div class="setting-text">
                            FeelGood Moments
                        </div>
                        <div class="push on" data-id="member_content_share_feel_good_moment">
                            <div class="sprite-icon circle-active"></div>
                        </div>
                        <div class="email on" data-id="member_content_share_feel_good_moment">
                        </div>
                    </div>


                    <div class="setting-item clearfix">
                        <div class="setting-text">
                            Weekly Email Digest
                        </div>
                        <div class="push on" data-id="weekly_digest_email">
                        </div>
                        <div class="email on" data-id="weekly_digest_email">
                            <div class="sprite-icon circle-active"></div>
                        </div>
                    </div>
                </div>-->
</div>
</div>

<!--
<div class="settings-item friends closed">
	<div class="settings-header clearfix">
		<div class="header-img sprite-icon friends-small"></div>
		<div class="header-text">Invite Friends &amp; Family</div>
		<div class="header-arrow down-arrow"></div>
	</div>
	<div class="settings-content">
		<div class="icon-list clearfix">
			<div class="media-icon sprite-icon email-icon"></div>
			<div class="media-icon sprite-icon facebook-icon" data="fb" track_event="invite_facebook"
			     track_data="{&quot;type&quot;: &quot;invite&quot;}"></div>
			<div class="media-icon sprite-icon twitter-icon" data="tw" track_event="invite_twitter"
			     track_data="{&quot;type&quot;: &quot;invite&quot;}"></div>
			<div class="media-icon sprite-icon google-icon" data="gplus" track_event="invite_google"
			     track_data="{&quot;type&quot;: &quot;invite&quot;}"></div>
		</div>
		<input class="generic-input hidden" type="text" placeholder="Emails (comma-separated)">

		<form class="feedback-form hidden">
			<div class="textarea_wrap" contenteditable="true">
				<div>
					<p>Join me on FinancialAsk - a place where you can ask top financial advisers your questions
						anytime, anywhere and get free answers.</p>

					<p>FinancialAsk is also great because I can:</p>
					<ul>
						<li>
							<b>* Learn more</b> about financial issues from advisers’ answers to members questions, and
							from tips and news items that advisers post
						</li>
						<li><b>* Get help</b> from advisers via live video conferencing when I need it most, 24/7</li>
						<li><b>* Take action</b> on my financial status by following adviser-created checklists.</li>
					</ul>
					<p></p>

					<p>FinancialAsk is a great way to take hold of your future!</p>
				</div>
			</div>
		</form>
		<div class="btn invite hidden" track_event="invite_email" track_data="{&quot;type&quot;: &quot;invite&quot;}">
			Send invitations
			<div></div>
		</div>
	</div>
</div>

-->

<div class="settings-item billing">
	<div class="settings-header clearfix">
		<div class="header-img sprite-icon card-small"></div>
		<div class="header-text">Billing Settings</div>
	</div>
	<div class="settings-options-list clearfix">
		<div class="settings-option your-plan closed">
			<div class="content-wrap clearfix">
				<div class="content-left">
					Your plan
				</div>
				<div class="content-right">Free</div>
			</div>
			<hr>
			<div class="settings-option-content">
				<div class="settings-option-content">
					<div class="plan-container settings ">
						<div class="info-wrap">
							<div class="value-props">
								<div class="prop">
									<div class="sprite-icon small-green-check"></div>
									<div class="prop-text">Talk to advisers live on any device, 24/7</div>
								</div>
								<div class="prop">
									<div class="sprite-icon small-green-check"></div>
									<div class="prop-text">Referrals, reminders, tips &amp; news</div>
								</div>
								<div class="prop">
									<div class="sprite-icon small-green-check"></div>
									<div class="prop-text">Share photos and chat with advisers anytime</div>
								</div>
							</div>
							<div class="plan-box clearfix subscribe">
								<div class="plan-price">
									<div class="big-price">
										<div class="dollar-sign">$</div>
										99
									</div>
									<div class="per"> USD per month</div>
									<div class="alt-currency subcribe_price"></div>
								</div>
								<div class="sprite-icon green-stamp"></div>
								<div class="add-others"> 100% Satisfaction Guaranteed</div>

							</div>
						</div>

					</div>

					<div class="btn-wrap clearfix">
						<div class="btn2 confirm btn-48-left">
							Subscribe
						</div>
						<div class="btn2 grey cancel btn-48-right">
							Cancel
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="settings-option credit-card closed">
			<div class="content-left">
				Your credit card
			</div>
			<div class="content-right">none</div>
			<div class="settings-option-content">
				<div>Your credit card</div>
				<div class="update-card-wrap">
					<div class="simple-CC-container clearfix">
						<div class="error" style="display: none;"></div>
						<form class="form-wrap clearfix">
							<div class="number-wrap clearfix">

								<div class="card-icon-container back">
									<div class="sprite-icon card-small-2 card-back"></div>
									<div class="sprite-icon card-front"></div>
								</div>

								<input type="text" class="generic-input simple_cc_number left"
								       placeholder="Enter card number" char-limit="25" data-index="0">
							</div>
							<input type="text" class="generic-input simple_cc_exp left" placeholder="MM/YY"
							       char-limit="7" data-index="1">
							<input type="text" class="generic-input simple_cc_cvv left" placeholder="CVV" char-limit="4"
							       data-index="2">
						</form>
					</div>
					<div class="btn-wrap">
						<div class="btn2 grey cancel">
							Cancel
						</div>
						<div class="btn2 disabled save">
							Save
						</div>
					</div>
				</div>
				<div class="btn-wrap card-options hidden">
					<div class="btn update_card" style="width: 100%; margin: 0 0 10px 0">
						Update Card
					</div>
					<div class="btn grey remove_card" style="width: 100%; margin: 0 0 10px 0">
						Remove Card
					</div>
					<div class="btn grey cancel" style="width: 100%;">
						Cancel
					</div>
				</div>
			</div>
		</div>
		<div class="settings-option transaction-history closed">
			<div class="content-left">
				Transaction history
			</div>
			<div class="content-right down-arrow"></div>
			<div class="settings-option-content"><!-- No Transactions -->
				<div class="none-wrap">
					<div class="none-text"> You have no transactions</div>
					<div class="prompt-container">
						<b style="font-weight: 300"> Questions? </b>

						<p class=""> Contact us at
							<a href="mailto:support@financialask.com.au">support@financialask.com.au</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- left-panel -->


<div class="right-panel">
	<div class="settings-item account">
		<div class="settings-header clearfix">
			<div class="header-img sprite-icon profile-small"></div>
			<div class="header-text">Account Settings</div>
		</div>
		<div class="settings-options-list clearfix">
			<div class="settings-option your-email closed">
				<div class="content-left">
					Your Email
				</div>
				<div class="content-right user-email"><?php echo $currentUser->email; ?></div>
				<div class="settings-option-content">
					<div class="error" style="display: none;"></div>
					<input class="generic-input email" type="email" value="">

					<div class="prompt-password"> Current Password</div>
					<input class="generic-input password" type="password">

					<div class="btn2 grey cancel">Cancel</div>
					<div class="btn2 save">Save</div>
				</div>
			</div>
			<div class="settings-option your-password closed">
				<div class="content-left">
					Your Password
				</div>
				<div class="content-right change-password">
					Change
				</div>
				<div class="settings-option-content">
					<div class="error" style="display: none;"></div>
					<input class="generic-input current_password" type="password" placeholder="Current Password">
					<input class="generic-input password" type="password" placeholder="New Password">
					<input class="generic-input password_confirmation" type="password" placeholder="Confirm Password">

					<div class="btn2 grey cancel">Cancel</div>
					<div class="btn2 save">Save</div>
				</div>
			</div>
			<?php
			if ($currentUser->userTypeID == User::TYPE_ADVISER) {
				?>
				<div class="settings-option your-rate closed">
					<div class="content-left">
						Your Hourly rate
					</div>
					<div class="content-right" id="user-rate"><?php echo $currentUser->adviserProfile->rate; ?></div>
					<div class="settings-option-content">
						<div class="error" style="display: none;"></div>
						<input class="generic-input number" type="number"
						       value="<?php echo $currentUser->adviserProfile->rate; ?>"/>
					</div>
				</div>
				<div class="settings-option direct-calls closed">
					<div class="content-left">
						Direct Calls
					</div>
					<div class="content-right" id="direct-calls-status">
						<?php echo Adviser::model()->getStatusList()[$currentUser->adviserProfile->directCalls]; ?>
					</div>
					<div class="settings-option-content">
						<?=CHtml::dropDownList(
							'directCalls',
							$currentUser->adviserProfile->directCalls,
							Adviser::model()->getStatusList(),
							array('class'=>'generic-input')
						)?>
					</div>
				</div>
			<?php
			}
			?>

		</div>
	</div>

	<div class="settings-item about">
		<div class="settings-header clearfix">
			<div class="header-img sprite-icon tap-logo-small"></div>
			<div class="header-text">About FinancialAsk</div>
		</div>
		<div class="settings-link-list clearfix">
			<a class="settings-link" href="/who_we_are" target="_self">Learn about FinancialAsk</a>
			<a class="settings-link" href="/terms" target="_blank">Terms of Service</a>
			<a class="settings-link" href="/terms/privacy_statement" target="_blank">Privacy Policy</a>
		</div>
	</div>
	<div class="settings-item booking">
		<div class="settings-header clearfix">
			<div class="header-img sprite-icon tap-logo-small"></div>
			<div class="header-text">Booking</div>
		</div>

		<div class="settings-link-list clearfix">
			<?= CHtml::link('Weekly schedule', array('schedule/index'), array('class' => 'settings-link')) ?>
			<?= CHtml::link('Manage booking', array('schedule/manage'), array('class' => 'settings-link')) ?>
		</div>
	</div>

	<div class="deactivate-wrap">
		<div class="deactivate-trigger">Deactivate account</div>
		<div class="settings-item deactivate-content" style="display: none">
			<div class="settings-header clearfix">
				<div class="header-img sprite-icon profile-small"></div>
				<div class="header-text">Deactivate Account</div>
			</div>
			<div class="settings-content">
				<div class="settings-text-header">
					Are you sure you want to close your FinancialAsk account?
				</div>
				<div class="settings-text">
					We're dedicated to taking care of you. Please consider letting us know how we may make your
					experience better instead of
					deactivating your account. We'll do our best to make you happy so soon as possible!
				</div>
				<div class="textarea_wrap">
					<form class="feedback-form" enctype="text/plain" action="mailto:feedback@financialask.com.au"
					      method="get">
						<input type="hidden" name="Subject" value="My feedback for FinancialAsk">
						<textarea class="form_comment" name="body"
						          placeholder="Please let us know how we can make your FinancialAsk experience better..."></textarea>
					</form>
				</div>
				<div class="btn2 feedback">Share Feedback</div>
				<div class="btn2 grey cancel">Cancel</div>
				<div class="btn2 grey deactivate">Deactivate</div>
			</div>
		</div>
	</div>
</div>
<!-- right-panel -->
</div>
