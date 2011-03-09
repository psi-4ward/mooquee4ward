
<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<div class="mooqueeWrapper">
	<div id="mooquee<?php echo $this->id;?>" class="mooquee" style="height:<?php echo $this->height+10;?>px;">
		<?php foreach($this->images as $img):?>
		<div class="mooquee_item" style="height:<?php echo $this->height+10;?>px;">
		<?php if($img['link']): ?>
		<a title="<?php echo $img['title'].'::'.$img['description'];?>" href="<?php echo $img['link']; ?>"<?php if($this->fullsize):?>rel="lightbox[mooquee4ward<?php echo $this->id;?>]"<?php endif;?>>
		<?php endif; ?>
		<img src="<?php echo $img['image']; ?>" alt="<?php echo $img['title'];?>" />
		<?php if($img['link']): ?>
		</a>
		<?php endif; ?>
		</div>
		<?php endforeach;?>
		<?php if($this->showNav):?>
		<div class="mooqueeNav">
			<?php for($i=0; $i<count($this->images);$i++):?>
			<a onclick="objMooquee<?php echo $this->id;?>.moove(<?php echo $i;?>);return false;" href="#" class="<?php if($this->firstitem == $i) echo 'active';?>"><?php echo $i;?></a>
			<?php endfor;?>
		</div>
		<?php endif;?>
	</div>
</div>
        
<!-- indexer::stop -->
<script type="text/javascript">
window.addEvent('domready',function(){
	objMooquee<?php echo $this->id;?> = new Mooquee({
		element:'mooquee<?php echo $this->id;?>',
		trans:{'tin':'<?php echo $this->transin;?>', 'tout':'<?php echo $this->transout;?>'},
		duration:<?php echo $this->duration;?>,
		pause:<?php echo $this->pause?>,
		firstitem:<?php echo $this->firstitem;?>,
		pauseOnHover:<?php echo $this->pauseOnHover;?>,
		transition:<?php echo $this->transition;?>,
	<?php if($this->showNav):?>
		onTransitionComplete: function(ci,pi){
			var els = $$('#mooquee<?php echo $this->id;?> div.mooqueeNav a');
			els.removeClass('active');
			els[ci].addClass('active');			
		},
	<?php endif;?>				
		startOnLoad:true
	});		
			
});
</script>
<!-- indexer::continue -->

</div>
