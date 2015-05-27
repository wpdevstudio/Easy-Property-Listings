<?php
/**
 * Author Box: Advanced Style
 *
 * @package EPL
 * @subpackage Theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<!-- Author Box Container Tabbed -->
<div id="epl-box<?php echo $epl_author->author_id; ?>" class="epl-author-box">		
	<ul class="epl-author-tabs">
		<?php
			
			$author_tabs = epl_author_tabs();
			$counter = 1;
			foreach($author_tabs as $k	=>	&$author_tab) {
				$current_class = $counter == 1? 'epl-author-current':''; ?>
				<?php 
					ob_start();
					apply_filters('epl_author_tab_'.$k.'_callback',call_user_func('epl_author_tab_'.str_replace(' ','_',$k), $epl_author ));
					$author_tab = array('label'	=>	$author_tab);
					$author_tab['content'] = ob_get_clean();
					// remove tab if callback function output is ''
					if(trim($author_tab['content']) == '')  {
						unset($author_tabs[$k]);
						continue;
					}
					
				?>

				<li class="tab-link <?php echo $current_class; ?>" data-tab="tab-<?php echo $counter;?>"><?php _e($author_tab['label'], 'epl'); ?></li><?php
				$counter ++;
			}
		?>
	</ul>

	<div class="epl-author-box-outer-wrapper epl-clearfix">			
		<div class="epl-author-box epl-author-image">
			<?php
				echo apply_filters('epl_author_tab_image',epl_author_tab_image($epl_author),$epl_author );
			?>
		</div>
		
		<?php
			$counter = 1;
			foreach($author_tabs as $k=>$tab) {
				$current_tab 	= strtolower('epl-author-'.$k);
				$current_class	= $counter == 1? 'epl-author-current':''; ?>
				<div id="tab-<?php echo $counter; ?>" class="<?php epl_author_class ($current_tab .' epl-author-tab-content '.$current_class) ?>">
					<?php
						echo $tab['content'];
					?>
				</div>
				<?php
				$counter ++;
			}
		?>
	</div>
</div>

