// 根据execute_cheats() 来设置显示隐藏区块id
(function (global) {
    var apple_phone         = /iPhone/i,
        apple_ipod          = /iPod/i,
        apple_tablet        = /iPad/i,
        android_phone       = /(?=.*\bAndroid\b)(?=.*\bMobile\b)/i, 
        android_tablet      = /Android/i,
        amazon_phone        = /(?=.*\bAndroid\b)(?=.*\bSD4930UR\b)/i,
        amazon_tablet       = /(?=.*\bAndroid\b)(?=.*\b(?:KFOT|KFTT|KFJWI|KFJWA|KFSOWI|KFTHWI|KFTHWA|KFAPWI|KFAPWA|KFARWI|KFASWI|KFSAWI|KFSAWA)\b)/i,
        windows_phone       = /IEMobile/i,
        windows_tablet      = /(?=.*\bWindows\b)(?=.*\bARM\b)/i, 
        other_blackberry    = /BlackBerry/i,
        other_blackberry_10 = /BB10/i,
        other_opera         = /Opera Mini/i,
        other_chrome        = /(CriOS|Chrome)(?=.*\bMobile\b)/i,
        other_firefox       = /(?=.*\bFirefox\b)(?=.*\bMobile\b)/i, 
        seven_inch = new RegExp('(?:' + 'Nexus 7' + '|' + 'BNTV250' + '|' + 'Kindle Fire' + '|' + 'Silk' + '|' + 'GT-P1000' + ')', 'i');           

    var match = function(regex, userAgent) {
        return regex.test(userAgent);
    };

    var IsMobileClass = function(userAgent) {
        var ua = userAgent || navigator.userAgent;

        var tmp = ua.split('[FBAN');
        if (typeof tmp[1] !== 'undefined') {
            ua = tmp[0];
        }        
        
        tmp = ua.split('Twitter');
        if (typeof tmp[1] !== 'undefined') {
            ua = tmp[0];
        }

        this.apple = {
            phone:  match(apple_phone, ua),
            ipod:   match(apple_ipod, ua),
            tablet: !match(apple_phone, ua) && match(apple_tablet, ua),
            device: match(apple_phone, ua) || match(apple_ipod, ua) || match(apple_tablet, ua)
        };
        this.amazon = {
            phone:  match(amazon_phone, ua),
            tablet: !match(amazon_phone, ua) && match(amazon_tablet, ua),
            device: match(amazon_phone, ua) || match(amazon_tablet, ua)
        };
        this.android = {
            phone:  match(amazon_phone, ua) || match(android_phone, ua),
            tablet: !match(amazon_phone, ua) && !match(android_phone, ua) && (match(amazon_tablet, ua) || match(android_tablet, ua)),
            device: match(amazon_phone, ua) || match(amazon_tablet, ua) || match(android_phone, ua) || match(android_tablet, ua)
        };
        this.windows = {
            phone:  match(windows_phone, ua),
            tablet: match(windows_tablet, ua),
            device: match(windows_phone, ua) || match(windows_tablet, ua)
        };
        this.other = {
            blackberry:   match(other_blackberry, ua),
            blackberry10: match(other_blackberry_10, ua),
            opera:        match(other_opera, ua),
            firefox:      match(other_firefox, ua),
            chrome:       match(other_chrome, ua),
            device:       match(other_blackberry, ua) || match(other_blackberry_10, ua) || match(other_opera, ua) || match(other_firefox, ua) || match(other_chrome, ua)
        };
        this.seven_inch = match(seven_inch, ua);
        this.any = this.apple.device || this.android.device || this.windows.device || this.other.device || this.seven_inch;
        
        this.phone = this.apple.phone || this.android.phone || this.windows.phone;

        this.tablet = this.apple.tablet || this.android.tablet || this.windows.tablet;

        if (typeof window === 'undefined') {
            return this;
        }
    };

    var instantiate = function() {
        var IM = new IsMobileClass();
        IM.Class = IsMobileClass;
        return IM;
    };

    if (typeof module !== 'undefined' && module.exports && typeof window === 'undefined') {
        module.exports = IsMobileClass;
    } else if (typeof module !== 'undefined' && module.exports && typeof window !== 'undefined') {
        module.exports = instantiate();
    } else if (typeof define === 'function' && define.amd) {
        define('isMobile', [], global.isMobile = instantiate());
    } else {
        global.isMobile = instantiate();
    }

})(this);

if(isMobile.any)
{
	//console.log('Driver Lock: Mode Gesture');
	document.addEventListener('touchstart', handleTouchStart, false);        
	document.addEventListener('touchmove', handleTouchMove, false);

	var xDown = null;                                                        
	var yDown = null;                                                        
	var displayed = false;
	var upcnt = 0;

	var cheats_contra = [2, 2, -2, -2, -1, 1, -1, 1, -1, 2];
	var pointer_contra = 0;

	var cheats_kof97_iori = [-1, 1, -1, 1, -1, 1, 2, -2];
	var pointer_kof97_iori = 0;

	function handleTouchStart(evt) {                                         
	    xDown = evt.touches[0].clientX;                                      
	    yDown = evt.touches[0].clientY;                                      
	};                                                

	function handleTouchMove(evt) {
	    if ( ! xDown || ! yDown ) {
	        return;
	    }

	    var xUp = evt.touches[0].clientX;                                    
	    var yUp = evt.touches[0].clientY;

	    var xDiff = xDown - xUp;
	    var yDiff = yDown - yUp;

	    if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
	    	// 1
	        if ( xDiff > 0 ) { //L
	            if (cheats_contra[pointer_contra] == -1) {
	            	pointer_contra++;
	            } else {
	            	pointer_contra = 0;
	            }
	        } else { //R
	            if (cheats_contra[pointer_contra] == 1) {
	            	pointer_contra++;
	            } else {
	            	pointer_contra = 0;
	            }
	        }  

	        // 2
			if ( xDiff > 0 ) { //L
	            if (cheats_kof97_iori[pointer_kof97_iori] == -1) {
	            	pointer_kof97_iori++;
	            } else {
	            	pointer_kof97_iori = 0;
	            }
	        } else { //R
	            if (cheats_kof97_iori[pointer_kof97_iori] == 1) {
	            	pointer_kof97_iori++;
	            } else {
	            	pointer_kof97_iori = 0;
	            }
	        }  
	    } else {
	    	// 1
	        if ( yDiff > 0 ) { //U
	            if (cheats_contra[pointer_contra] == 2) {
	            	pointer_contra++;
	            } else {
	            	pointer_contra = 0;
	            }
	        } else { //D
	            if (cheats_contra[pointer_contra] == -2) {
	            	pointer_contra++;
	            } else {
	            	pointer_contra = 0;
	            }
	        } 

	        //2
	        if ( yDiff > 0 ) { //U
	            if (cheats_kof97_iori[pointer_kof97_iori] == 2) {
	            	pointer_kof97_iori++;
	            } else {
	            	pointer_kof97_iori = 0;
	            }
	        } else { //D
	            if (cheats_kof97_iori[pointer_kof97_iori] == -2) {
	            	pointer_kof97_iori++;
	            } else {
	            	pointer_kof97_iori = 0;
	            }
	        } 
	    }

	    // 1
	    if (pointer_contra >= cheats_contra.length) {
	    	// displayed = true;
	    	execute_cheats(1);
	    }

		// 2
	    if (pointer_kof97_iori >= cheats_kof97_iori.length)
	    {
	    	execute_cheats(2);
	    }

	    xDown = null;
	    yDown = null;                                            
	};
} else {
	//console.log('Driver Lock: Mode Keyboard');
	(function ($) {
	    var pointer_contra = 0;
	    var pointer_kof97_iori = 0;
	    // var displayed = false;
	    $(document).on('keydown.passwordCheck', function (event) {
	        // if (displayed)
	        //    return;

	        // 秘技1
	        var cheats_contra = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65];
	        if ((event.keyCode == cheats_contra[pointer_contra])
	            || (event.which === cheats_contra[pointer_contra])) {
	            pointer_contra++;
	        } else {
	            pointer_contra = 0;
	        }
			if (pointer_contra >= cheats_contra.length) {
	            // displayed = true;
	            execute_cheats(1);
	        }

	        // 秘技2
			var pointer_kof97_iori = [37, 39, 37, 39, 37, 39, 65, 67];
	        if ((event.keyCode == pointer_kof97_iori[pointer_kof97_iori])
	            || (event.which === pointer_kof97_iori[pointer_kof97_iori])) {
	            pointer_kof97_iori++;
	        } else {
	            pointer_kof97_iori = 0;
	        }
			if (pointer_kof97_iori >= pointer_kof97_iori.length) {
	            // displayed = true;
	            execute_cheats(2);
	        }

	    });
	})(jQuery);
}

// 执行区块显示隐藏
function execute_cheats(cheats_type)
{
	if(cheats_type == 1)
	{
		var show_block = document.getElementById('cheats_show_1');
	    if(show_block != null)
	   		show_block.style.display = 'none';
	    var hide_block = document.getElementById('cheats_hide_1');
	    if(hide_block != null)
	    	hide_block.style.display = 'inline';
	}
	else if(cheats_type == 2)
	{
		var show_block = document.getElementById('cheats_show_2');
	    if(show_block != null)
	   		show_block.style.display = 'none';
	    var hide_block = document.getElementById('cheats_hide_2');
	    if(hide_block != null)
	    	hide_block.style.display = 'inline';
	}
}