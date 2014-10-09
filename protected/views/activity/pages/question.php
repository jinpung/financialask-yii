<div class="feed-item-author clearfix">
	<div class="avatar left"
	     style="background-image: url({{feed.question.user.avatarUrl||'/img/default-avatar.png'}})"></div>
	<div class="feed-header-text">
		<a class="author-name">
{{feed.question.user.name||"A USER"}}
		</a>
		<span>asked:</span>
	</div>
</div>

<div class="feed-item-content">
	<div class="answer-icon"></div>
	<a class="question" href="/questions/{{feed.question.id}}">
		{{ feed.question.content }}
	</a>
</div>
