/*################## start animation on scroll####################*/
SOSFunction();
function SOSFunction(){

  let sos_slide = document.querySelectorAll('*[data-sos]');
  if(sos_slide.length > 0){
    
    const slideOnScrollObserver_options = {
      //rootMargin:'-50px',
      //threshold:0.15,
    };
    const slideOnScrollObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        entry.target.classList.toggle(entry.target.getAttribute('data-sos') ,entry.isIntersecting);
        if(entry.target.getAttribute('data-sos-once') == 'true' ){
          if(entry.isIntersecting){
            slideOnScrollObserver.unobserve(entry.target);
          }
        }
          
      });
    },slideOnScrollObserver_options);
    
    sos_slide.forEach(ele => {
      slideOnScrollObserver.observe(ele);
    });
  }
}

COSFunction();
function COSFunction() {
  let cos_slide = document.querySelectorAll('*[data-cos]');
  if(cos_slide.length > 0){
    const slideOnScrollObserver_options = {
      //rootMargin:'-50px',
      //threshold:0.15,
    };
    let Time = 2000 / 60,
    totFrms = Math.round( 2000 / Time );
    
    const slideOnScrollObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        countUp(entry.target ,Time ,totFrms);
        if(entry.isIntersecting){
          slideOnScrollObserver.unobserve(entry.target);
        }
          
      });
    },slideOnScrollObserver_options);
    
    cos_slide.forEach(ele => {
      slideOnScrollObserver.observe(ele);
    });
  }
};
function countUp(ele ,Time ,totFrms){
  let frame = 0,
    countTo = parseInt( $(ele).attr('data-cos'), 10 ),
    counter = setInterval( () => {
      frame++;
      let progress =  (frame / totFrms)*(2-(frame / totFrms)),
      currentCount = Math.round( countTo * progress );

      if ( parseInt( ele.innerHTML, 10 ) !== currentCount ) {
        ele.innerHTML = currentCount;
      }

      if ( frame === totFrms ) {
        clearInterval( counter );
      }
    }, Time );
}
/*################## end animation on scroll######################*/
