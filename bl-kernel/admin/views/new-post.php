<?php

HTML::title(array('title'=>$L->g('New post'), 'icon'=>'pencil'));

HTML::formOpen(array('class'=>'uk-form-stacked'));

	// Security token
	HTML::formInputHidden(array(
		'name'=>'tokenCSRF',
		'value'=>$Security->getTokenCSRF()
	));

// LEFT SIDE
// --------------------------------------------------------------------
echo '<div class="uk-grid uk-grid-medium">';
echo '<div class="bl-publish-view uk-width-8-10">';

	// Title input
	HTML::formInputText(array(
		'name'=>'title',
		'value'=>'',
		'class'=>'uk-width-1-1 uk-form-large',
		'placeholder'=>$L->g('Title')
	));

	// Content input
	HTML::formTextarea(array(
		'name'=>'content',
		'value'=>'',
		'class'=>'uk-width-1-1 uk-form-large',
		'placeholder'=>''
	));

	// Form buttons
	echo '<div class="uk-form-row uk-margin-bottom">
		<button class="uk-button uk-button-primary" type="submit">'.$L->g('Save').'</button>
		<button class="uk-button uk-button-primary" type="button" id="jsSaveDraft">'.$L->g('Save as draft').'</button>
		<a class="uk-button" href="'.HTML_PATH_ADMIN_ROOT.'manage-posts">'.$L->g('Cancel').'</a>
	</div>';

echo '</div>';

// RIGHT SIDE
// --------------------------------------------------------------------
echo '<div class="bl-publish-sidebar uk-width-2-10">';

	echo '<ul>';

	// GENERAL TAB
	// --------------------------------------------------------------------
	echo '<li><h2 class="sidebar-button" data-view="sidebar-general-view"><i class="uk-icon-angle-down"></i> '.$L->g('General').'</h2></li>';
	echo '<li id="sidebar-general-view" class="sidebar-view">';

	/*
	HTML::formSelect(array(
		'name'=>'category',
		'label'=>$L->g('Category'),
		'class'=>'uk-width-1-1 uk-form-medium',
		'options'=>$dbCategories->getAll(),
		'selected'=>'',
		'tip'=>'',
		'addEmptySpace'=>true
	));*/

	// Description input
	HTML::formTextarea(array(
		'name'=>'description',
		'label'=>$L->g('description'),
		'value'=>'',
		'rows'=>'4',
		'class'=>'uk-width-1-1 uk-form-medium',
		'tip'=>$L->g('this-field-can-help-describe-the-content')
	));

	echo '</li>';

	// IMAGES TAB
	// --------------------------------------------------------------------
	echo '<li><h2 class="sidebar-button" data-view="sidebar-images-view"><i class="uk-icon-angle-down"></i> '.$L->g('Images').'</h2></li>';
	echo '<li id="sidebar-images-view" class="sidebar-view">';

	// --- BLUDIT COVER IMAGE ---
	HTML::bluditCoverImage();

	// --- BLUDIT QUICK IMAGES ---
	HTML::bluditQuickImages();

	// --- BLUDIT IMAGES V8 ---
	HTML::bluditImagesV8();

	// --- BLUDIT MENU V8 ---
	HTML::bluditMenuV8();

	echo '</li>';

	// TAGS
	// --------------------------------------------------------------------
	echo '<li><h2 class="sidebar-button" data-view="sidebar-tags-view"><i class="uk-icon-angle-down"></i> '.$L->g('Tags').'</h2></li>';
	echo '<li id="sidebar-tags-view" class="sidebar-view">';

	// Tags input
	HTML::tags(array(
		'name'=>'tags',
		'label'=>'',
		'allTags'=>$dbTags->getAll(),
		'selectedTags'=>array()
	));

	echo '</li>';

	// ADVANCED TAB
	// --------------------------------------------------------------------
	echo '<li><h2 class="sidebar-button" data-view="sidebar-advanced-view"><i class="uk-icon-angle-down"></i> '.$L->g('Advanced').'</h2></li>';
	echo '<li id="sidebar-advanced-view" class="sidebar-view">';

	// Status input
	HTML::formSelect(array(
		'name'=>'status',
		'label'=>$L->g('Status'),
		'class'=>'uk-width-1-1 uk-form-medium',
		'options'=>array('published'=>$L->g('Published'), 'draft'=>$L->g('Draft')),
		'selected'=>'published',
		'tip'=>''
	));

	// Date input
	HTML::formInputText(array(
		'name'=>'date',
		'value'=>Date::current(DB_DATE_FORMAT),
		'class'=>'uk-width-1-1 uk-form-large',
		'tip'=>$L->g('To schedule the post just select the date and time'),
		'label'=>$L->g('Date')
	));

	// Slug input
	HTML::formInputText(array(
		'name'=>'slug',
		'value'=>'',
		'class'=>'uk-width-1-1 uk-form-large',
		'tip'=>$L->g('you-can-modify-the-url-which-identifies'),
		'label'=>$L->g('Friendly URL')
	));

	echo '</li>';
	echo '</ul>';

echo '</div>';
echo '</div>';

HTML::formClose();

?>

<script>

$(document).ready(function() {

	$("#jsdate").datetimepicker({format:"<?php echo DB_DATE_FORMAT ?>"});

	$("#jstitle").keyup(function() {
		var slug = $(this).val();
		checkSlugPost(slug, "", $("#jsslug"));
	});

	$("#jsslug").keyup(function() {
		var slug = $("#jsslug").val();
		checkSlugPost(slug, "", $("#jsslug"));
	});

	// Button Save as draft
	$("#jsSaveDraft").on("click", function() {
		$("#jsstatus").val("draft");
		$(".uk-form").submit();
	});

	// Right sidebar
	$(".sidebar-button").click(function() {
		var view = "#" + $(this).data("view");

		if( $(view).is(":visible") ) {
			$(view).hide();
		}
		else {
			$(".sidebar-view").hide();
			$(view).show();
		}
	});

});

</script>