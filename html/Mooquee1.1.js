/*
 * Mooquee 	  - mootools <marquee> tag replacement
 * Version	  - 1.1.1
 * Created By - Robert Inglin
 * Homepage   - http://robert.ingl.in/mooquee
 * Thanks to  - *mltsy* of Mooforum.net who wrote rewrote the 
		    transition system to allow in and out style 
		    transitions and included the fade transition
 * License    - MIT License Agreement

Copyright (c) 2008 Robert Inglin

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
 */

Mooquee = new Class({
	Implements: [Options],

	options: {
		element: 'mooquee',
		cssitem: 'mooquee_item',
		firstitem:0,
		trans:{'tin':'left', 'tout':'left'}, //each transition is up, down, left, right, fade
		pause: 1000, //milliseconds (keep pause equal or higher to duration to allow time for items to reset) -1 = infinite pause/no loop
		duration: 1000, //number of milliseconds to move marquee items
		overflow:'hidden', //if your item flows over how do you want to handle it. Auto(scroll) or Hidden work best...
		startOnLoad:true, // will start marquee when loaded
		pauseOnHover: true, //if true will pause all animations while mouse is hovering
		onTransitionStart: function(){},// Executes on transition start
		onTransitionComplete: function(curr){
//			this.items.setStyle('z-index',100);
//			this.items[curr].setStyle('z-index',1000);
		}, // Executes on transition completion
		onLoop: function(){}//Executes on full loop
	},
	initialize: function(options){
		this.setOptions(options);
		this.defaultVariables();
		
		if (typeof(this.options.trans) == "string") this.options.trans = {'tin':this.options.trans, 'tout':this.options.trans};
		
		window.addEvent('domready', function() {
			this.items = $$('#' + this.options.element + ' .' + this.options.cssitem);//get all mooqueeItems
			this.totalitems = this.items.length;
			// if($(this.options.element).style.overflow != 'hidden')			$(this.options.element).style.overflow = 'hidden';
			if($(this.options.element).style.position != 'relative')		$(this.options.element).style.position = 'relative';

			this.setMooqueeFXs();
			this.setTrans(this.options.trans);//has setMooqueeItems in it

			if(this.options.startOnLoad)
				this.startLoop();
			if(this.options.pauseOnHover){
				$(this.options.element).addEvent('mouseover',function(){this.pauseM()}.bind(this));
				$(this.options.element).addEvent('mouseout',function(){this.resume()}.bind(this));
			}
		}.bind(this));
		
		
	},
	setMooqueeItems: function(){
		this.resetting =true;
		var i=0;
		
		this.items.each(function (element){
			if($(element).style.position != 'absolute')
				$(element).style.position = 'absolute';
			$(element).style.width = $(this.options.element).clientWidth + 'px';
			$(element).style.overflow = this.options.overflow;

			if(i == this.currentitem)
				this.itemFXs[i].set(this.resetStyle).set(this.inStyle);
			else
				this.itemFXs[i].set(this.resetStyle).set(this.startStyle);
			i++;

		}.bind(this));
		this.resetting =false;
	},
	setMooqueeFXs: function(){
		var i=0;
		this.items.each(function (element){
			this.itemFXs[i] = new Fx.Morph(element,{duration:(this.options.duration),transition:this.options.transition});
			i++;
		}.bind(this));
	},
	mooveAll: function(){
		if((this.currentitem + 1) == this.totalitems){
			citem = 0;
			this.options.onLoop();
		}else
			citem = this.currentitem + 1;
		this.moove(citem);
	},
	moove: function(itemnumber){
		if(itemnumber < this.totalitems)
		if(!this.mousedOver){
			if(itemnumber != this.currentitem){
				$clear(this.loopTimer);
				if(this.previousitem != -1){
					this.itemFXs[this.previousitem].cancel().set(this.resetStyle).set(this.startStyle);
					this.itemFXs[this.currentitem].cancel().set(this.resetStyle).set(this.inStyle);
					this.previousitem=-1;
				}
				this.returnpreviousitem = this.previousitem = this.currentitem;
				this.returncurrentitem = this.currentitem = itemnumber;
				this.options.onTransitionStart(this.returncurrentitem,this.returnpreviousitem);

				this.itemFXs[this.previousitem].start(this.outStyle).chain(function(){
					if(!this.resetting){
						this.itemFXs[this.previousitem].set(this.resetStyle).set(this.startStyle);
						this.previousitem=-1;
					}
				}.bind(this));

				(function(){
					this.itemFXs[this.currentitem].start(this.inStyle).chain(function(){
						this.options.onTransitionComplete(this.returncurrentitem,this.returnpreviousitem);
						if(this.loop == true)
							this.loopTimer = this.mooveAll.delay(this.pause ,this);
					}.bind(this));
				}).delay(this.inDelay*this.pause ,this);

			}
		}else{
			this.moove.delay(50 ,this,itemnumber);	
		}
		
	},
    setTrans: function(newTrans){
        this.startStyle = {}
        this.inStyle = {};
        this.outStyle = {};
        this.resetStyle = {};
        this.inDelay = 0;
        switch(newTrans.tin){
                case 'up':
                    this.startStyle = {'top': $(this.options.element).clientHeight};
                    this.inStyle = {'top': 0};
                break;
                case 'down':
                    this.startStyle = {'top': $(this.options.element).clientHeight * -1};
                    this.inStyle = {'top': 0};
                break;
                case 'left':
                    this.startStyle = {'left': $(this.options.element).clientWidth};
                    this.inStyle = {'left': 0};
                break;
                case 'right':
                    this.startStyle = {'left': $(this.options.element).clientWidth * -1};
                    this.inStyle = {'left': 0};
                break;
                case 'fade':
                    this.startStyle = {'opacity': 0};
                    this.inStyle = {'opacity': 1};
                break;
        }
        switch(newTrans.tout){
                case 'up':
                    this.outStyle = {'top': $(this.options.element).clientHeight * -1};
                    this.resetStyle = {'top': 0};
                break;
                case 'down':
                    this.outStyle = {'top': $(this.options.element).clientHeight};
                    this.resetStyle = {'top': 0};
                break;
                case 'left':
                    this.outStyle = {'left': $(this.options.element).clientWidth * -1};
                    this.resetStyle = {'left': 0};
                break;
                case 'right':
                    this.outStyle = {'left': $(this.options.element).clientWidth};
                    this.resetStyle = {'left': 0};
                break;
                case 'fade':
                    this.outStyle = {'opacity': 0};
                    this.resetStyle = {'opacity': 1};
                    this.inDelay = .5;
                break;
        }
        this.setMooqueeItems();
    	},
	pauseM: function(){
		if(this.previousitem != -1){
			this.itemFXs[this.previousitem].pause();
			this.itemFXs[this.currentitem].pause();
		}
		this.mousedOver = true;
	},
	resume: function(){
		if(this.previousitem != -1){
			this.itemFXs[this.previousitem].resume();
			this.itemFXs[this.currentitem].resume();
		}
		this.mousedOver = false;
	},
	stopLoop: function(){
		this.loop = false;
		this.pause = 2;
	},
	startLoop: function(pause,duration){
		if(pause)this.pause = pause;
		this.loop = true;
		this.loopTimer = this.mooveAll.delay(this.pause ,this);
	},
	defaultVariables: function(){
		if(this.options.pause!=-1){
			this.loop = true;
			this.pause = this.options.pause;
		}else{
			this.loop = false;
			this.pause = 2;
		}
		this.duration = this.options.duration;
		this.itemFXs = [];
		this.outDelay = 0;
        	this.inDelay = 0;
		this.started = false;
		this.currentitem = this.options.firstitem;
		this.previousitem=-1;
	}
});
