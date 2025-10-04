

/*################# start select box ##########################*/
  class LuxurySelect {
    constructor(element) {
      this.select = element;
      this.trigger = element.querySelector('.luxury-select__trigger');
      this.value = element.querySelector('.luxury-select__value');
      this.icon = element.querySelector('.luxury-select__icon');
      this.dropdown = element.querySelector('.luxury-select__dropdown');
      this.options = element.querySelectorAll('.luxury-select__option');
      
      this.init();
    }
    
    init() {
      this.trigger.addEventListener('click', () => this.toggleDropdown());
      
      this.options.forEach(option => {
        option.addEventListener('click', () => this.selectOption(option));
        option.addEventListener('keydown', (e) => {
          if (e.key === 'Enter' || e.key === ' ') {
            this.selectOption(option);
          }
        });
      });
      
      document.addEventListener('click', (e) => {
        if (!this.select.contains(e.target)) {
          this.closeDropdown();
        }
      });
      
      // Keyboard navigation
      this.trigger.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
          e.preventDefault();
          this.openDropdown();
          
          if (e.key === 'ArrowDown') {
            this.focusFirstOption();
          } else {
            this.focusLastOption();
          }
        }
      });
    }
    
    toggleDropdown() {
      this.dropdown.classList.toggle('luxury-select__dropdown--open');
      this.trigger.setAttribute('aria-expanded', 
        this.dropdown.classList.contains('luxury-select__dropdown--open'));
      
      if (this.dropdown.classList.contains('luxury-select__dropdown--open')) {
        this.icon.style.transform = 'rotate(180deg)';
      } else {
        this.icon.style.transform = 'rotate(0)';
      }
    }
    
    openDropdown() {
      this.dropdown.classList.add('luxury-select__dropdown--open');
      this.trigger.setAttribute('aria-expanded', 'true');
      this.icon.style.transform = 'rotate(180deg)';
    }
    
    closeDropdown() {
      this.dropdown.classList.remove('luxury-select__dropdown--open');
      this.trigger.setAttribute('aria-expanded', 'false');
      this.icon.style.transform = 'rotate(0)';
    }
    
    selectOption(option) {
      this.options.forEach(opt => opt.classList.remove('luxury-select__option--selected'));
      option.classList.add('luxury-select__option--selected');
      
      const text = option.querySelector('.luxury-select__option-text').textContent;
      this.value.textContent = text;
      
      const value = option.dataset.value;
      console.log('Selected value:', value);
      
      this.closeDropdown();
      this.trigger.focus();
    }
    
    focusFirstOption() {
      this.options[0].focus();
    }
    
    focusLastOption() {
      this.options[this.options.length - 1].focus();
    }
  }
  
  // Initialize all select elements
  document.querySelectorAll('.luxury-select').forEach(select => {
    new LuxurySelect(select);
  });

/*################# end select box ##########################*/

/*################# start scrolling-button ##########################*/
  $( window ).scroll(function() {
    let scroll_max=document.body.offsetHeight - window.innerHeight +30;
    let scroll_value=$(document).scrollTop();
    let persent_value=Math.ceil((scroll_value*100)/scroll_max);
    $('.progress-scroll-bage-x').css('width', `${persent_value}%` );
 });
  $('.scroll-button-top').click(function(){
      $(document).scrollTop(0);
  });
/*################# end scrolling-button ##########################*/


$(".card").hover(
  function(){
    $(this).removeClass("shadow-sm");
    $(this).addClass("shadow");
  },
  function(){
    $(this).removeClass("shadow");
    $(this).addClass("shadow-sm");
  }
);

function add_glossy(){
  $("button,a.btn,input[type='button']").hover(function(){
    $(this).addClass("glossyBtn");
  }, function(){
    $(this).removeClass("glossyBtn");
  });
}
$(document).ready(function(){
  add_glossy();
  $('*').removeClass("placeholder");
});

/*  هذا لحل مشكلة تغيير تنسيق الصفحة عند فتح السايد بار*/
document.getElementById('sidebarToggle').addEventListener('click', function() {
document.body.style.overflow = 'auto'; 
document.body.style.padding = '0'; 
});



let lastScrollPosition = window.scrollY || window.pageYOffset;

window.addEventListener('scroll', function() {
const currentScrollPosition = window.scrollY || window.pageYOffset;
if(currentScrollPosition > 30){
  $('.navbar').addClass("navbar-free");
  $('.scroll-button-top').removeClass("scroll-button-to-hidden");
  }else if(currentScrollPosition < 30){
    $('.navbar').removeClass("navbar-free");
    $('.scroll-button-top').addClass("scroll-button-to-hidden");
  }
  
  if (currentScrollPosition > lastScrollPosition) {
    // التمرير لأسفل
    $('.navbar').addClass("off-navbar");
  } else if (currentScrollPosition < lastScrollPosition) {
      // التمرير لأعلى
    $('.navbar').removeClass("off-navbar");
  }

lastScrollPosition = currentScrollPosition <= 0 ? 0 : currentScrollPosition;
});
