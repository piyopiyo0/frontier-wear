document.addEventListener("DOMContentLoaded", function () {
    let swiper = new Swiper(".header__more-slider", {
        spaceBetween: 10,
        slidesPerView: 1,
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1000: {
                slidesPerView: 3,
            },
            1280: {
                slidesPerView: 4.5,
            },
        },
    });
});


function updateHeaderClassMobile() {
  const header = document.querySelector('.header-mobile');
  if (!header) return;
  if (window.innerWidth < 768) {
        header.classList.add('header-transparent');
  } else {
        header.classList.remove('header-transparent');
  }
}
updateHeaderClassMobile()
window.addEventListener('resize', updateHeaderClassMobile);

const headerMenuContent = document.querySelector('.header__menu-content');
const header = document.querySelector('.header');
const popupUsers = document.querySelectorAll('.popupUser')
const popupInners = document.querySelectorAll('.popupUser__inner');
const headerSearch = document.querySelector('.header__search');
const headerBusketBtn = document.querySelector('.header__busket-open');
const headerBagOpen = document.querySelector('.basket__item-open');
const headerBg = document.querySelector('.header__bg');
const headerMain = document.querySelector('.header-main');

const basket = document.querySelector('.basket');
const basketInner = document.querySelector('.basket__inner');
const basketOpenBtn = document.querySelector('.header__busket-open');
document.querySelectorAll('.header__search-open, .header__search-close').forEach((e) => {
    e.addEventListener('click', () => {
        headerSearch.classList.toggle('active');
        headerBusketBtn.classList.remove('active');
        headerMenuContent.classList.remove('active');
        headerBagOpen.classList.remove('active');
    });
});
if(headerBusketBtn){
    headerBusketBtn.addEventListener('click', function() {
        popupUsers.forEach(element => {
            element.classList.remove('active');
        });
        basket.classList.toggle('active');
    });
}


document.querySelectorAll('.popupUser-register-open').forEach(element => {
    element.addEventListener('click', function() {
        popupUsers.forEach(element => {
            element.classList.remove('active');
        });
        basket.classList.remove('active');
        document.querySelector('.popupUser-register').classList.add('active');
    });
});
document.querySelectorAll('.popupUser-login-open').forEach(element => {
    element.addEventListener('click', function() {
        popupUsers.forEach(element => {
            element.classList.remove('active');
        });
        basket.classList.remove('active');
        document.querySelector('.popupUser-login').classList.add('active');
    });
});


document.addEventListener('click', (e) => {
    const isButtonClick = e.target.closest('.basket__btn-register, .basket__btn-login');
    if (!isButtonClick) {
        const isClickInside = Array.from(popupInners).some(inner => 
            inner.contains(e.target)
        );
        if (!isClickInside) {
            popupUsers.forEach(popup => {
                popup.classList.remove('active');
            });
        }
    }
});


function updateHeaderClass() {
    const header = document.querySelector('.header-transparent');
    const scrollPosition = window.scrollY || window.pageYOffset;
    const viewportHeight = window.innerHeight;

    if (header) {
        if (scrollPosition >= viewportHeight - 41) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    }
    if(document.querySelector('.header-mobile')){
        if (header) {
            if (scrollPosition >= viewportHeight - 350) {
                header.classList.add('header-scrolled');
            } else {
                header.classList.remove('header-scrolled');
            }
        }
    }

    if(document.querySelector('.header-main')){
        if (header) {
            if (scrollPosition >= viewportHeight - 350) {
                header.classList.add('header-scrolled');
            } else {
                header.classList.remove('header-scrolled');
            }
        }
    }

}

window.addEventListener('load', updateHeaderClass);
window.addEventListener('resize', updateHeaderClass);
window.addEventListener('scroll', updateHeaderClass);


document.addEventListener('DOMContentLoaded', function () {
    const headerOpenLink = document.querySelector('.header__link-open');
    const headerBg = document.querySelector('.header__bg');
    const header = document.querySelector('.header');

    if (headerOpenLink && header) {
        headerOpenLink.addEventListener('click', function (e) {
            e.preventDefault();
            header.classList.toggle('header-menu-open');
        });
    }

    if (headerBg && header) {
        headerBg.addEventListener('click', function () {
            header.classList.toggle('header-menu-open');
        });
    }
});

document.querySelectorAll('h3.header__mobile-name').forEach(header => {
    header.addEventListener('click', function() {
        if (this.classList.contains('active')) {
            this.classList.remove('active');
        } else {
            document.querySelectorAll('h3.header__mobile-name').forEach(h => {
                h.classList.remove('active');
            });
            this.classList.add('active');
        }
    });
});



let swiperInstances = new Map();

function handleSliders() {
    const aboutSectionImages = document.querySelectorAll('.aboutSection__images');
    if (!aboutSectionImages.length) return;
    aboutSectionImages.forEach((slider) => {
        const parent = slider.closest('.aboutSection__images-content');
        const paginationEl = parent ? parent.querySelector('.aboutSection__images-pagination') : null;

        if (window.innerWidth < 768) {
            if (!swiperInstances.has(slider) && paginationEl) {
                const swiper = new Swiper(slider, {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    pagination: {
                        el: paginationEl,
                        clickable: true,
                    },
                });
                swiperInstances.set(slider, swiper);
                slider.classList.add('swiper');
            }
        } else {
            if (swiperInstances.has(slider)) {
                const swiper = swiperInstances.get(slider);
                swiper.destroy(true, true);
                swiperInstances.delete(slider);
            }
            slider.classList.remove('swiper');
            const wrapper = slider.querySelector('.swiper-wrapper');
            if (wrapper) {
                wrapper.style.transform = '';
                wrapper.style.transition = '';
                wrapper.style.display = '';
            }
            const slides = slider.querySelectorAll('.swiper-slide');
            slides.forEach(slide => {
                slide.style.transform = '';
                slide.style.transition = '';
                slide.style.width = '';
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', handleSliders);
window.addEventListener('resize', handleSliders);

if(document.querySelector('.header__menu-open')){
    document.querySelector('.header__menu-open').addEventListener('click', function() {
        document.querySelector('.header').classList.toggle('header-menu-mobile');
    });
}






document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.querySelector('.popupUser__form-register');
    const popupUser = document.querySelector('.popupUser');
    const emailInput = registerForm.querySelector('input[name="email"]');
    const passwordInput = registerForm.querySelector('input[name="password"]');
    const agreeCheckbox = registerForm.querySelector('input[name="agreed"]');
    const emailError = registerForm.querySelector('.popupUser__form-error:nth-of-type(1)');
    const passwordError = registerForm.querySelector('.popupUser__form-error:nth-of-type(2)');
    const agreeError = registerForm.querySelector('.popupUser__form-agreed');

    function hideAllErrors() {
        emailError.style.display = 'none';
        passwordError.style.display = 'none';
        agreeError.style.display = 'none';
        popupUser.classList.remove('popupUser-error');
        emailInput.classList.remove('error');
        passwordInput.classList.remove('error');
    }
    emailInput.addEventListener('input', () => {
        if (emailInput.value.trim()) {
            emailInput.classList.remove('error');
            emailError.style.display = 'none';
        }
    });
    passwordInput.addEventListener('input', () => {
        if (passwordInput.value.trim()) {
            passwordInput.classList.remove('error');
            passwordError.style.display = 'none';
        }
    });

    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        hideAllErrors();

        if (!emailInput.value.trim()) {
            emailError.style.display = 'block';
            popupUser.classList.add('popupUser-error');
            emailInput.classList.add('error');
            return;
        }

        if (!passwordInput.value.trim()) {
            passwordError.style.display = 'block';
            popupUser.classList.add('popupUser-error');
            passwordInput.classList.add('error');
            return;
        }

        if (!agreeCheckbox.checked) {
            agreeError.style.display = 'block';
            popupUser.classList.add('popupUser-error');
            return;
        }

        console.log('Form is valid, ready to submit');
    });
});



document.querySelectorAll('[data-bag-color]').forEach(element => {
    element.style.backgroundColor = element.getAttribute('data-bag-color');
});




const totalPriceElement = document.querySelector('.basket__total');
const itemCounts = document.querySelectorAll('.basket__item-count input');
const bagInner = document.querySelector('.basket__content');
const bagDescr = document.querySelector('.basket__number');
const bagTitle = document.querySelector('.basket__title');
const orderButton = document.querySelector('.basket__order');

function updateTotal() {
    const items = document.querySelectorAll('.basket__item');
    let total = 0;
    items.forEach((item, index) => {
        const priceText = item.querySelector('.basket__item-price').textContent;
        const price = parseFloat(priceText.replace(' UAH', '').replace(' ', ''));
        const quantity = parseInt(itemCounts[index].value, 10);
        total += price * quantity;
    });
    totalPriceElement.textContent = `Загальна сума: ${total.toFixed(2)} UAH`;
}

function updateBagDescription() {
    const visibleItems = document.querySelectorAll('.basket__item').length;
    const text = visibleItems === 1 ? `${visibleItems} товар` : `${visibleItems} товари`;
    bagDescr.textContent = text;
}

function handleItemChange(event) {
    const button = event.target.closest('button');
    if (!button) return;
    const inputField = button.closest('.basket__item-count').querySelector('input');
    let count = parseInt(inputField.value, 10);
    if (button.classList.contains('basket__item-plus')) {
        count++;
    } else if (button.classList.contains('basket__item-minus') && count > 1) {
        count--;
    }
    if (count > 99) {
        count = 99;
    }
    inputField.value = count;
    updateTotal();
    updateBagDescription();
    toggleBagEmptyState();
}

function handleManualInput(event) {
    let count = parseInt(event.target.value, 10);
    if (isNaN(count) || count < 1) {
        count = 1;
    } else if (count > 99) {
        count = 99;
    }
    event.target.value = count;
    updateTotal();
    updateBagDescription();
    toggleBagEmptyState();
}

function handleItemDelete(event) {
    const item = event.target.closest('.basket__item');
    item.remove();
    updateTotal();
    updateBagDescription();
    toggleBagEmptyState();
}

function toggleBagEmptyState() {
    const visibleItems = document.querySelectorAll('.basket__item').length;
    if (visibleItems === 0) {
        bagInner.style.display = 'none';
        bagDescr.style.display = 'none';
        bagTitle.textContent = 'Ваш кошик порожній';
        orderButton.style.display = 'none';
    } else {
        bagInner.style.display = 'block';
        bagDescr.style.display = 'block';
        bagTitle.textContent = 'Ваш кошик';
        orderButton.style.display = 'block';
    }
}

document.querySelectorAll('.basket__item-plus').forEach(button => {
    button.addEventListener('click', handleItemChange);
});

document.querySelectorAll('.basket__item-minus').forEach(button => {
    button.addEventListener('click', handleItemChange);
});

document.querySelectorAll('.basket__item-delete').forEach(button => {
    button.addEventListener('click', handleItemDelete);
});

itemCounts.forEach(input => {
    input.addEventListener('input', handleManualInput);
});

updateTotal();
updateBagDescription();
toggleBagEmptyState();