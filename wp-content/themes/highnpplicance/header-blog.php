<?php
$cat = get_query_var('cat');
$current_tag = single_tag_title("", false);
$search = '';
if (isset($_REQUEST['s'])) {
	$search = $_REQUEST['s'];
}


//echo $current_tag;
if ($cat)
	$selected = $cat;
else
	$selected = 0;


$args = array(
	'show_option_all' => '',
	'show_option_none' => 'Select Category',
	'orderby' => 'ID',
	'order' => 'ASC',
	'show_count' => 0,
	'hide_empty' => 1,
	'child_of' => 0,
	'exclude' => '1',
	'echo' => 1,
	'selected' => $selected,
	'hierarchical' => 0,
	'name' => 'cat',
	'id' => '',
	'class' => 'selectbox',
	'depth' => 0,
	'tab_index' => 0,
	'taxonomy' => 'category',
	'hide_if_empty' => false
);
?>
<div class="blog-page ninja-field--primary ">
	<div class="blog-top nf-field-element bg-brand-primary ">
		<div class="blog-box cell-6 cell-992-12">
		<?php
            wp_dropdown_categories($args);
        ?>
        <script type="text/javascript">
			var dropdown = document.getElementById("cat");
			function onCatChange() {
		              if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
							location.href = "<?php
echo get_option('home');
?>/?cat="+dropdown.options[dropdown.selectedIndex].value;


						}else{


							location.href = "<?php
echo get_option('home');
?>/health-blog";

						}
					}

					dropdown.onchange = onCatChange;

				</script>

			</div>

			<div class="blog-box search-box cell-6 cell-992-12 ">

				<?php

if (is_archive()) {
	global $wp;
	$action = home_url($wp->request);
} else {
	$action = home_url('/');
}
?>

				<form role="search" class="d-flex" method="get" id="searchform" action="<?php
echo $action;
?>">

					<?php
if (!is_archive()) {
?>
						<input type="hidden" name="post_type" value="post" />
					<?php
}
?>

					<input type="text"  class="search-box" value="<?php //echo $search;
?>" name="s" id="s" placeholder="Search"/>

					<input type="submit" id="searchsubmit" value="Go" />


				</form>


			</div>


		</div>


</div>
