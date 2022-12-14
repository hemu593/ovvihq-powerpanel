/*
 * jQuery jFontSize Plugin
 * Examples and documentation: http://jfontsize.com
 * Author: Frederico Soares Vanelli
 *         fredsvanelli@gmail.com
 *         http://twitter.com/fredvanelli
 *         http://facebook.com/fred.vanelli
 *
 * Copyright (c) 2011
 * Version: 1.0 (2011-07-15)
 * Dual licensed under the MIT and GPL licenses.
 * http://jfontsize.com/license
 * Requires: jQuery v1.2.6 or later
 */

(function($){
    $.fn.jfontsize = function(opcoes) {
        var $this=$(this);
	    var defaults = {
		    btnMinusClasseId: '#jfontsize-minus',
		    btnDefaultClasseId: '#jfontsize-default',
		    btnPlusClasseId: '#jfontsize-plus',
            btnMinusMaxHits: 10,
            btnPlusMaxHits: 10,
            sizeChange: 1
	    };

        if (opcoes){opcoes = $.extend(defaults, opcoes)};

        var limite=new Array();
        var fontsize_padrao=new Array();

        $(this).each(function(i){
            limite[i]=0;
            fontsize_padrao[i];
        });

        $(opcoes.btnMinusClasseId+', '+opcoes.btnDefaultClasseId+', '+opcoes.btnPlusClasseId).removeAttr('href');
        $(opcoes.btnMinusClasseId+', '+opcoes.btnDefaultClasseId+', '+opcoes.btnPlusClasseId).css('cursor', 'pointer');

        $(opcoes.btnMinusClasseId).click(function(){
            $(opcoes.btnPlusClasseId).removeClass('jfontsize-disabled');
            $this.each(function(i){
                if (limite[i]>(-(opcoes.btnMinusMaxHits))){
                    fontsize_padrao[i]=$(this).css('font-size');
                    fontsize_padrao[i]=fontsize_padrao[i].replace('px', '');
                    fontsize=$(this).css('font-size');
                    fontsize=parseInt(fontsize.replace('px', ''));
                    fontsize=fontsize-(opcoes.sizeChange);
                    fontsize_padrao[i]=fontsize_padrao[i]-(limite[i]*opcoes.sizeChange);
                    limite[i]--;
                    Cookies.set('fontSizeCookie', fontsize);
                    $(this).css('font-size', fontsize+'px');
                    if (limite[i]==(-(opcoes.btnMinusMaxHits))){
                        $(opcoes.btnMinusClasseId).addClass('jfontsize-disabled');
                    }
                }
            })
        });

        $(opcoes.btnDefaultClasseId).click(function(){
            $(opcoes.btnMinusClasseId).removeClass('jfontsize-disabled');
            $(opcoes.btnPlusClasseId).removeClass('jfontsize-disabled');
            $this.each(function(i){
                limite[i]=0;                
                Cookies.remove('fontSizeCookie');
                $(this).css('font-size', '');
                //$(this).css('font-size', fontsize_padrao[i]+'px');
            })
        });

        $(opcoes.btnPlusClasseId).click(function(){
            $(opcoes.btnMinusClasseId).removeClass('jfontsize-disabled');
            $this.each(function(i){
                if (limite[i]<opcoes.btnPlusMaxHits){
                    fontsize_padrao[i]=$(this).css('font-size');
                    fontsize_padrao[i]=fontsize_padrao[i].replace('px', '');
                    fontsize=$(this).css('font-size');
                    fontsize=parseInt(fontsize.replace('px', ''));
                    fontsize=fontsize+opcoes.sizeChange;
                    fontsize_padrao[i]=fontsize_padrao[i]-(limite[i]*opcoes.sizeChange);
                    limite[i]++;
                    Cookies.set('fontSizeCookie', fontsize);
                    var ass = $(this).css('font-size', fontsize+'px');
                    if (limite[i]==opcoes.btnPlusMaxHits){
                        $(opcoes.btnPlusClasseId).addClass('jfontsize-disabled');
                    }
                }
            })
        });
        if (Cookies.get('fontSizeCookie')) {
            var fontSize = Cookies.get("fontSizeCookie");
            $('.inner-page-gap').css({'font-size': fontSize+'px'});
        }
    };
})(jQuery);


$('.inner-page-gap, .home-welcome, .home-short-service, .home-welcome-text, .home-service, .home-news').jfontsize({
    btnMinusClasseId: '#jfontsize-m',
    btnDefaultClasseId: '#jfontsize-d',
    btnPlusClasseId: '#jfontsize-p',
    btnMinusMaxHits: 3, // How many times the size can be decreased
    btnPlusMaxHits: 3, // How many times the size can be increased
    sizeChange: 1 // Defines the range of change in pixels
});