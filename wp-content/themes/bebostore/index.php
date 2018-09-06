<?php
//Index default template
get_header();
if (is_home()) {
	get_template_part('templates/archive', 'default');
}else{
	get_template_part('templates/section','one-column-full');
}
get_footer();
?>