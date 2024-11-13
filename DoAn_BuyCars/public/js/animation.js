const text_banner = document.querySelector('.text-banner'); 
const container_products = document.querySelector('.container-products'); 
const product_pagination = document.querySelector('.product-pagination'); 
const text_product_new = document.querySelector('.text-product-new'); 
const product_news = document.querySelector('.product-news'); 
const text_about = document.querySelector('.text-about'); 
const about_footerr = document.querySelector('.about-footerr'); 
const about_footerrr = document.querySelector('.about-footerrr'); 
const btn_footerr = document.querySelector('.btn-footerr'); 
const qq = document.querySelector('.qq'); 
const icon_footer = document.querySelector('.icon-footer'); 

function isIntoView(el) {
    const rect = el.getBoundingClientRect();
    return rect.bottom <= window.innerHeight;
}

isIntoView(text_banner);
isIntoView(container_products);
isIntoView(product_pagination);
isIntoView(text_product_new);
isIntoView(product_news);
isIntoView(text_about);
isIntoView(about_footerr);
isIntoView(about_footerrr);
isIntoView(btn_footerr);
isIntoView(qq);
isIntoView(icon_footer);




window.addEventListener("scroll", () => {
  
    if (isIntoView(text_banner)) {
        text_banner.classList.add("active");
        console.log('Class active đã được thêm vào');
    }
    if (isIntoView(container_products)) {
        container_products.classList.add("active");
        console.log('Class active đã được thêm vào');
    }
    if (isIntoView(product_pagination)) {
        product_pagination.classList.add("active");
        console.log('Class active đã được thêm vào');
    }
    if (isIntoView(text_product_new)) {
        text_product_new.classList.add("active");
        console.log('Class active đã được thêm vào');
    }
    if (isIntoView(product_news)) {
        product_news.classList.add("active");
        console.log('Class active đã được thêm vào');
    }
    if (isIntoView(text_about)) {
        text_about.classList.add("active");
        console.log('Class active đã được thêm vào');
    }
    if (isIntoView(about_footerr)) {
        about_footerr.classList.add("active");
        console.log('Class active đã được thêm vào');
    }
    if (isIntoView(about_footerrr)) {
        about_footerrr.classList.add("active");
        console.log('Class active đã được thêm vào');
    }
    if (isIntoView(btn_footerr)) {
        btn_footerr.classList.add("active");
        console.log('Class active đã được thêm vào');
    }
    if (isIntoView(qq)) {
        qq.classList.add("active");
        console.log('Class active đã được thêm vào');
    }
    if (isIntoView(icon_footer)) {
        icon_footer.classList.add("active");
        console.log('Class active đã được thêm vào');
    }
})


