jQuery(window).load(function() { 
    jQuery('.flexslider').flexslider({controlNav: false}); 
}); 

function kropes_fs(sel,direction){
  var slider = jQuery(sel).data('flexslider'); 
  slider.flexAnimate(slider.getTarget(direction));
}
