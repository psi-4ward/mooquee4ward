</div>

<script type="text/javascript">
<!--//--><![CDATA[//><!--
window.addEvent('domready',function(){
	$$('#mooquee<?php echo $this->startId;?> > div').addClass('mooquee_item');

	<?php if($this->showNav):?>
		var mooqueeNav = new Element('div',{'class':'mooqueeNav'});
		for(var i=0; i<$$('#mooquee<?php echo $this->startId;?> > div').length;i++){
			new Element('a',{
				'onclick':'objMooquee<?php echo $this->startId;?>.moove('+i+');return false;',
				'href':'#',
				'class':((i==0) ? 'active' : ''),
				'text':i
			}).inject(mooqueeNav);
			mooqueeNav.set('html',mooqueeNav.get('html')+' ');
		}
		mooqueeNav.inject($('mooquee<?php echo $this->startId;?>'));
	<?php endif;?>
		
	objMooquee<?php echo $this->startId;?> = new Mooquee({
		element:'mooquee<?php echo $this->startId;?>',
		trans:{'tin':'<?php echo $this->transin;?>', 'tout':'<?php echo $this->transout;?>'},
		duration:<?php echo $this->duration;?>,
		pause:<?php echo $this->pause?>,
		firstitem:<?php echo $this->firstitem;?>,
		pauseOnHover:<?php echo $this->pauseOnHover;?>,
		transition:<?php echo $this->transition;?>,
	<?php if($this->showNav):?>
		onTransitionComplete: function(ci,pi){
			var els = $$('#mooquee<?php echo $this->startId;?> div.mooqueeNav a');
			els.removeClass('active');
			els[ci].addClass('active');			
		},
	<?php endif;?>				
		startOnLoad:true
	});		

});
//--><!]]>
</script>