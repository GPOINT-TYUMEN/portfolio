		<div class="category">
			<div class="title">Каталог</div>
			<div class="block">
				<?foreach($tree as $t):?>
				<div class="item">
					<?if($t['img']):?><div class="images" style="background-image: url(/img/categories/70x100/<?=$t['img'];?>);"></div><?endif;?>
					<div class="info">
						<p class="first"><a href="/catalog/<?=$t['uri_name'];?>/"><?=$t['name'];?></a></p>
						<?$x = 1;foreach($t['children'] as $c):?>
						<p class="cmenu<?=$t['id'];?>"<?if($x > 4):?> style="display:none;"<?endif;?>><a href="/catalog/<?=$c['uri_name'];?>/"><?=$c['name'];?></a></p>
						<?$x++;endforeach;?>
					</div>
					<?if(count($t['children']) > 4):?>
					<div class="more"><a class="dotted cmenu_show" data-id="<?=$t['id'];?>" href="javascript:void();">Показать ещё</a></div>
					<?endif;?>
				</div>
				<?endforeach;?>
			</div>
		</div>

<script>
$(document).ready(function(){
	$(".cmenu_show").click(function(){
		var i = $(this).attr("data-id");
		$(".cmenu"+i).show();
		$(this).parent("div").remove();
	});
});
</script>