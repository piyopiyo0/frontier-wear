document.querySelectorAll('.catalog__sort-content label').forEach(label => {
    label.addEventListener('click', () => {
        document.querySelectorAll('.catalog__sort-content label').forEach(item => {
            item.classList.remove('active');
        });
        label.classList.add('active');
    });
});
document.querySelectorAll('.catalog__refine label').forEach(label => {
    label.addEventListener('click', () => {
        document.querySelectorAll('.catalog__refine label').forEach(item => {
            item.classList.remove('active');
        });
        label.classList.add('active');
    });
});

const catalogTopItems = document.querySelectorAll(".catalog__top-item");
function checkCatalogBottom() {
    if (window.innerWidth > 767) {
        document.querySelectorAll('.catalog__bottom')[0].style.display = 'flex';
    }
    else {
        catalogTopItems.forEach(topItem => {
            if (topItem.classList.contains("active") && topItem.getAttribute("data-select") === "highlights") {
                document.querySelectorAll('.catalog__bottom')[0].style.display = 'none';
            }
        });
    }
}
window.addEventListener("resize", checkCatalogBottom);
checkCatalogBottom()
catalogTopItems.forEach(button => {
    button.addEventListener('click', () => {
        const targetClass = button.dataset.select;
        if(targetClass !== 'highlights'){
            document.querySelectorAll('.catalog__bottom')[0].style.display = 'flex';
        }
        
        if(targetClass == 'switch'){
            const targetElement = document.querySelector(`.${targetClass}`);
            if (targetElement) {
                targetElement.classList.add('active');
            }

            document.querySelector('.catalog__top').style.display = 'none';
            document.querySelector('.catalog__select').style.display = 'none';
            document.querySelector('.catalog__switch').classList.add('active')
            document.querySelectorAll('.catalog__bottom')[0].style.display = 'none';
        }
        else if (targetClass) {
            catalogTopItems.forEach(item => {
                item.classList.remove('active');
            });
            button.classList.add('active');
            document.querySelectorAll('.catalog__select-item').forEach(element => {
                element.classList.remove('active');
            });

            const targetElement = document.querySelector(`.${targetClass}`);
            if (targetElement) {
                targetElement.classList.add('active');
            }
            checkCatalogBottom()
        }
    });
});
const featured = document.querySelectorAll('.featured');
const sortOpen = document.querySelectorAll('.catalog__sort-open');
const sortClose = document.querySelectorAll('.catalog__sort-close');
sortOpen.forEach(element => {
    element.addEventListener('click', () => {
        element.closest('.featured').classList.add('active');
    });
});
sortClose.forEach(element => {
    element.addEventListener('click', () => {
        element.closest('.featured').classList.remove('active');
    });
});

document.addEventListener('click', (event) => {
    if (![...featured].some(item => item.contains(event.target)) && ![...sortOpen, ...sortClose].some(button => button.contains(event.target))) {
        featured.forEach(item => item.classList.remove('active'));
    }
});
const switchBack = document.querySelectorAll('.catalog__switch-back');
const allLis = document.querySelectorAll('.catalog__switch-content li');
const allUls = document.querySelectorAll('.catalog__switch-content ul');
const switchButtons = document.querySelectorAll('.catalog__switch-content button[type="button"]');
switchButtons.forEach(button => {
    button.addEventListener('click', function() {
        const allLis = document.querySelectorAll('.catalog__switch-content li');
        const allUls = document.querySelectorAll('.catalog__switch-content ul');
        allLis.forEach(li => li.classList.remove('selected'));
        allUls.forEach(ul => ul.classList.remove('selected'));
        const parentLi = button.closest('li');
        const parentUl = button.closest('ul');
        parentLi.classList.add('selected');
        parentUl.classList.add('selected');
    });
});
document.querySelector('.catalog__switch-close').addEventListener('click', () => {
    switchClose()
});
function switchClose() {
    document.querySelector('.catalog__top').style.display = 'flex';
    document.querySelector('.catalog__select').style.display = 'block';
    document.querySelector('.catalog__switch').classList.remove('active')
    allLis.forEach(li => li.classList.remove('selected'));
    allUls.forEach(ul => ul.classList.remove('selected'));

    if (catalogTopItems[0].classList.contains("active") && catalogTopItems[0].getAttribute("data-select") === "highlights" && window.innerWidth < 768) {
        document.querySelectorAll('.catalog__bottom')[0].style.display = 'none';
    }
    else{
        document.querySelectorAll('.catalog__bottom')[0].style.display = 'flex';
    }
}
switchBack.forEach(backButton => {
    backButton.addEventListener('click', () => {
        let hasSelected = false;
        allUls.forEach(ul => {
            if (ul.classList.contains('selected')) {
                hasSelected = true;
            }
        });
        if (!hasSelected) {
            switchClose();
        } else {
            allLis.forEach(li => li.classList.remove('selected'));
            allUls.forEach(ul => ul.classList.remove('selected'));
        }
    });
});
const productItemBtn = document.querySelectorAll('.product__item-btn');
productItemBtn.forEach(element => {
    element.addEventListener('click', () => {
        element.closest('.product__item').classList.toggle('clicked');
    });
});



const linkFixed = document.querySelector(".pageContent__link-fixed");
const contentPage = document.querySelector(".pageContent");
const contentPageContent = document.querySelector(".pageContent__content");
if (linkFixed && contentPage && contentPageContent) {
    const handleScrollBody = () => {
        if (window.scrollY > 10 && window.innerWidth < 768) {
            linkFixed.classList.add("scrolled");
        } else {
            linkFixed.classList.remove("scrolled");
        }
    };

    const moveLink = () => {
        const catalogContainer = document.querySelector(".pageContent__catalog");
        if (window.innerWidth < 768) {
            if (linkFixed.classList.contains("catalog__bottom") && catalogContainer) {
                catalogContainer.appendChild(linkFixed);
            } else {
                contentPage.appendChild(linkFixed);
            }
        } else if (!contentPageContent.contains(linkFixed)) {
            contentPageContent.appendChild(linkFixed);
        }
    };

    window.addEventListener("scroll", handleScrollBody);
    window.addEventListener("resize", moveLink);
    handleScrollBody();
    moveLink();
}