<style> .pb-widget .dialog-modal{display:none;}</style>
<?php global $post;

$meta = (array)get_post_meta($post->ID, 'page_builder_data', true); //printr($meta);
$structure = kvalue( $meta, 'structure' );
$sidebars_other = kvalue( $meta, 'sidebars' );
if( isset( $meta['structure'] ) ) unset( $meta['structure'] );
if( isset( $meta['sidebars'] ) ) unset( $meta['sidebars'] );//printr(array_values($meta)); ?>
<script type="text/javascript">
	var default_settings = <?php echo json_encode($default_settings);?>;
	var field_settings = <?php echo json_encode(array_values($meta));?>;
	var sidebars = <?php echo json_encode($sidebars);?>;
	var sidebars_selected = <?php echo json_encode($sidebars_other ); ?>;
	var struct  = '<?php echo $structure; ?>';
	jQuery(document).ready(function($) {
        //$(".form_style").jqTransform({imgPath:"/includes/views/js/img/"});
    });
</script>

<?php foreach($fields as $k=>$v):?>
<script type="text/x-jquery-tmpl" id="layout-<?php echo $k;?>-style">
	<?php foreach($v as $vk=>$vv): 
	
		if( kvalue( $vv, 'type' ) == 'hidden' ) continue;?>
		<div class="control-group">
			<label for="inputEmail" class="control-label"><?php echo kvalue($vv, 'label');?></label>
			
			<div class="controls">
				<?php echo $this->_webnukes->html->generator('layout[${counter}][data]['.$vk.']', $vv, array('layout[${counter}][data]['.$vk.']'=>'${'.$vk.'}'), 'element');?>
				
				<?php if( kvalue( $vv, 'info' ) ): ?>
					<span class="help-block"><?php echo kvalue($vv, 'info');?></span>
				<?php endif; ?>
			</div>	
		</div>
		<hr class="sp">
		
	<?php endforeach;?>
	
	<div class="widgetSettings" style="display:none;">{{html widgetSettings}}</div>
</script>
<?php endforeach;?>

<script type="text/x-jquery-tmpl" id="layout-widget">
	<div class="pb-col${cols}" id="${id}__${counter}">
		<div class="pb-widget">
			<div class="pb-addRem"> <a href="#" class="plus-size"></a> <a href="#" class="minus-size"></a> </div>
			<div class="pb-hold-widge">
				<div class="hold-up">${title} <span>${cols}/${max_col}</span> </div>
				<div class="hold-down">
					<a href="#" class="move-widge"></a>
					
					<a href="#" class="edit-widge"></a>
					
					<a href="#" class="remove-widge"></a>
					
				</div>
			</div>

			<div class="layout-dialog-model">
				<div class="dialog-container">
					{{tmpl "widgetFields"}}
				</div>
			</div>
		</div>
	</div>
</script>
<div id="fw_temp"></div>
<div id="wrap">
	<article class="pb-masthead">
		<div class="pb-heading"><?php _e('Page Builder', THEME_NAME); ?></div>
		<div class="pb-head">
			<ul class="layouts">
            	<?php $layout = array('full', 'right', 'left', 'left2', 'right2', 'both'); 
				foreach( $layout as $lay):
					$checked = ( 'col-'.$lay == $structure ) ? 'checked="checked"' : '';
					$chosen = ( 'col-'.$lay == $structure ) ? ' chosen' : '';?>
					<li class="col-<?php echo $lay . $chosen; ?>"><i class="icon-chosen"></i><input type="radio" value="<?php echo $lay;?>" class="btn-radio" style="display:none;" <?php echo $checked; ?> /></li>
                <?php endforeach;?>
			</ul>
			
			<input type="hidden" name="layout[structure]" id="l-structure" value="<?php echo $structure; ?>" />
		</div>
	</article>
	<!-- pb-masthead ends -->
	<div id="content-wrapper" class="clearfix">
        <div class="pb-builder-content">
        	<article class="pb-content">
          		<aside class="sidebars">
                	<div class="pb-heading"><?php _e('Available Modules', THEME_NAME);?></div>
                    <div class="available-bars">
                        <div class="pb-bars clearfix" id="layout-ctrls">
                            <?php foreach($default_settings as $k=>$v):?>
                                <a href="javascript:void(0);">
                                	<i class="icon-<?php echo $k;?>"></i><?php echo slugtotext($k);?>
                                    <i class="addRem-widge"></i>
                                </a>
                            <?php endforeach;?>
                        </div>
                    </div>
                </aside>

				<div id="layout-structure">
					<section class="pb-main">
						<div class="pb-col-container clearfix" id="layout-content"></div>
						<!--div class="pb-col-container clearfix">THIS IS CONTENT SECTION.</div>-->
					</section>
				</div>
            </article>
        </div>
	</div>
</div>
<div id="layout-dialog"></div>