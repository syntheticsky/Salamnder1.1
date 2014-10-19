 <div class="pyre_metabox">
<?php
$this->select(	'page_title',
				'Page Title Bar',
				array('show' => 'Show', 'hide' => 'Hide'),
				''
			);
?>
<?php
$this->select(	'page_title_text',
				'Page Title Bar Text',
				array('show' => 'Show', 'hide' => 'Hide'),
				''
			);
?>
<?php
$this->select(	'slider_type',
				'Slider Type',
				array('no' => 'No Slider', 'layer' => 'LayerSlider', 'flex' => 'FlexSlider', 'flex2' => 'ThemeFusion Slider', 'rev' => 'Revolution Slider', 'elastic' => 'Elastic Slider'),
				''
			);
?>
<?php
global $wpdb;
$slides_array[0] = 'Select a slider';
// Table name
$table_name = $wpdb->prefix . "layerslider";

// Get sliders
$sliders = $wpdb->get_results( "SELECT * FROM $table_name
									WHERE flag_hidden = '0' AND flag_deleted = '0'
									ORDER BY date_c ASC LIMIT 100" );

if(!empty($sliders)):
foreach($sliders as $key => $item):
	$slides[$item->id] = '';
endforeach;
endif;

if($slides){
foreach($slides as $key => $val){
	$slides_array[$key] = 'LayerSlider #'.($key);
}
}
$this->select(	'slider',
				'Select LayerSlider',
				$slides_array,
				''
			);
?>
<?php
$slides_array = array();
$slides = array();
$slides_array[0] = 'Select a slider';
$slides = get_terms('slide-page');
if($slides && !isset($slides->errors)){
$slides = is_array($slides) ? $slides : unserialize($slides);
foreach($slides as $key => $val){
	$slides_array[$val->slug] = $val->name;
}
}
$this->select(	'wooslider',
				'Select FlexSlider',
				$slides_array,
				''
			);
?>
<?php
$slides_array = array();
$slides_array[0] = 'Select a slider';
$i = 1;
$data = $this->data;
while($i <= $data['flexsliders_number']){
	$slides_array['flexslider_'.$i] = 'TFSlider'.$i;
	$i++;
}
$this->select(	'flexslider',
				'Select ThemeFusion Slider',
				$slides_array,
				''
			);
?>
<?php
global $wpdb;
$get_sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
$revsliders[0] = 'Select a slider';
if($get_sliders) {
	foreach($get_sliders as $slider) {
		$revsliders[$slider->alias] = $slider->title;
	}
}
$this->select(	'revslider',
				'Select Revolution Slider',
				$revsliders,
				''
			);
?>
<?php
$slides_array = array();
$slides_array[0] = 'Select a slider';
$slides = get_terms('themefusion_es_groups');
if($slides && !isset($slides->errors)){
$slides = is_array($slides) ? $slides : unserialize($slides);
foreach($slides as $key => $val){
	$slides_array[$val->slug] = $val->name;
}
}
$this->select(	'elasticslider',
				'Select Elastic Slider',
				$slides_array,
				''
			);
?>
<?php $this->upload('fallback', 'Slider Fallback Image'); ?>
<?php
$this->select(	'full_width',
				'Page: Full Width',
				array('no' => 'No', 'yes' => 'Yes'),
				''
			);
?>
<?php
$this->select(	'sidebar_position',
				'Page: Sidebar Position',
				array('default' => 'Default', 'right' => 'Right', 'left' => 'Left'),
				''
			);
?>
<?php
$this->text(	'portfolio_excerpt',
				'Portfolio: Excerpt Length',
				''
			);
?>
<?php
$this->select(	'portfolio_full_width',
				'Portfolio: Full Width',
				array('yes' => 'Yes', 'no' => 'No'),
				''
			);
?>
<?php
$this->select(	'portfolio_sidebar_position',
				'Portfolio: Sidebar Position',
				array('default' => 'Default', 'right' => 'Right', 'left' => 'Left'),
				''
			);
?>
<?php
$types = get_terms('portfolio_category', 'hide_empty=0');
$types_array[0] = 'All categories';
if($types) {
	foreach($types as $type) {
		$types_array[$type->term_id] = $type->name;
	}
$this->multiple(	'portfolio_category',
				'Portfolio Type',
				$types_array,
				'Choose what portfolio category you want to display on this page. Leave blank for all categories.'
			);
}
?>
<?php
$this->select(	'portfolio_filters',
				'Show Portfolio Filters',
				array('yes' => 'Show', 'no' => 'Hide'),
				''
			);
?>
<?php
$this->text(	'page_bg_color',
				'Background Color (Hex Code)',
				''
			);
?>
<?php $this->upload('page_bg', 'Background Image'); ?>
<?php
$this->select(	'page_bg_full',
				'100% Background Image',
				array('no' => 'No', 'yes' => 'Yes'),
				''
			);
?>
<?php
$this->select(	'page_bg_repeat',
				'Background Repeat',
				array('repeat' => 'Tile', 'repeat-x' => 'Tile Horizontally', 'repeat-y' => 'Tile Vertically', 'no-repeat' => 'No Repeat'),
				''
			);
?>
<?php $this->upload('page_title_bar_bg', 'Page Title Bar Background'); ?>
<?php $this->upload('page_title_bar_bg_retina', 'Page Title Bar Background Retina'); ?>
<?php
$this->text(	'page_title_bar_bg_color',
				'Page Title Bar Background Color (Hex Code)',
				''
			);
?>
<?php
$this->select(	'image_rollover_icons',
				'Image Rollover Icons',
				array('linkzoom' => 'Link + Zoom', 'link' => 'Link', 'zoom' => 'Zoom', 'no' => 'No Icons'),
				''
			);
?>
<?php
$this->text(	'link_icon_url',
				'Link Icon URL',
				'Leave blank for post URL'
			);
?>
</div>