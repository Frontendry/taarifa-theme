// Main App Funcs
(function($) {
    "use strict";

    const   windowEl = window, 
            bodyEl = document.body,
            headerHeroDefault = document.querySelectorAll('.default-hhh'),   
            heroImages = document.querySelectorAll('.img-hs'), 
            heroImagesArray = Array.apply(null,heroImages),
            heroImages2 = document.querySelectorAll('.img-hs2'), 
            heroImages2Array = Array.apply(null,heroImages2),
            heroImages3 = document.querySelectorAll('.img-hs3'), 
            heroImages3Array = Array.apply(null,heroImages3),
            heroRs = document.querySelectorAll('.hs-rs'),  
            iframeVids = document.querySelectorAll('.iframe-vid'),   
            iframeVidsArray = Array.apply(null,iframeVids),
            mainHeader = document.querySelectorAll('.main-header'), 
            logoNavMiscHeaderEls = document.querySelectorAll('.logo-nav-misc-h'), 
            logoNavMiscHeaderElsArray = Array.apply(null,logoNavMiscHeaderEls),
            navMiscHeaderEls = document.querySelectorAll('.nav-misc-h'),
            navMiscHeaderElsArray = Array.apply(null,navMiscHeaderEls),
            navOutHeader = document.querySelector('.nav-out-hhh'),
            searchCol = document.querySelector('.search-col'),
            navCol = document.querySelector('.nav-col'),
            miscCol = document.querySelector('.misc-col'),
            fullPostHeaderEl = document.querySelectorAll('.blog-post-top-header'),
            fullBlogPostHead = document.querySelectorAll('.blog-post-full-head'),
            heroCarousels = document.querySelectorAll('.hero-carousel'), 
            heroCarouselsArray = Array.apply(null,heroCarousels),  
            heroCarousels2 = document.querySelectorAll('.hero-carousel-2 .carousel-list'), 
            heroCarousels2Array = Array.apply(null,heroCarousels2),
            heroCarousels3 = document.querySelectorAll('.hero-carousel-3 .carousel-list'), 
            heroCarousels3Array = Array.apply(null,heroCarousels3),    
            stickyWraps = document.querySelectorAll('.sticky-wrap'), 
            contentAreaIn = document.querySelectorAll('.content-area-in'),
            sidePaginationEnabled = document.querySelectorAll('.side-pagination-enabled'),            
            frPostNavs = document.querySelectorAll('.fr-posts-nav'), 
            frPostNavsArray = Array.apply(null,frPostNavs),  
            masonryGrids = document.querySelectorAll('.masonry-grid-layout'), 
            masonryGridsArray = Array.apply(null,masonryGrids),
            topSocialIcons = document.querySelectorAll('.top-social-icon'),
            topSocialIconsArray = Array.apply(null,topSocialIcons),
            $mainNavLis = $('.main-nav li'),
            postGallerys = document.querySelectorAll('.post-gallery-in'),
            postGallerysArray = Array.apply(null,postGallerys),
            postGalleryImageConts = document.querySelectorAll('.post-gallery figure a'),
            postGalleryImageContsArray = Array.apply(null,postGalleryImageConts),
            carouselPagination = document.querySelector('.carousel-pagination-navs'),
            mainFooter = document.querySelectorAll('.main-footer'),
            jsAos = document.querySelectorAll('.js-aos'),
            jsAosArray = Array.apply(null,jsAos),
            $videoAudioEls = $('video, audio'),
            galleryModalTrigger = document.querySelectorAll('.gallery-trigger a'),
            galleryModalClose = document.querySelectorAll('.back-post button'),
            galleryModalCont = document.querySelectorAll('.gallery-modal'),
            galleryModalNav = document.querySelectorAll('.gallery-modal-nav'),
            galleryCounterPosition = document.querySelectorAll('.gallery-counter-position'),
            galleryCounterTotal = document.querySelectorAll('.gallery-counter-total'),
            gallerypostCarousel = document.querySelectorAll('.gallery-modal-carousel'),
            modalGridMasonry = document.querySelectorAll('.gallery-modal-masonry'),
            modalGridMasonryArray = Array.apply(null,modalGridMasonry),
            viewAllGrids = document.querySelectorAll('.view-all-gmn'),
            captionContainer = document.querySelectorAll('.gallery-modal-image-caption p'),
            singleGridImgString = '.single-grid-image',
            postsCont = document.querySelectorAll('.articles-display-in'),
            loadMoreButton = document.querySelectorAll('.fr-loadmore button'),
            commentScroll = document.querySelectorAll('.comment-icon'),
            commentScrollSection = document.querySelectorAll('#comments'),
            postsSocialShare = document.querySelectorAll('.social-posts-share'),
            wrapNewFn = function(el,wrapper){            
                el.parentNode.insertBefore(wrapper, el);                
                wrapper.appendChild(el);
            },
            imgToBg = function(el){
                const   imgAll = el.querySelectorAll('img'),
                        imgarray = Array.apply(null,imgAll);

                imgarray.map(function(img){
                    const imgUrl = img.getAttribute('src');                    
                    img.parentNode.style.backgroundImage = 'url('+imgUrl+')';                    
                });
            },
            getClosest = function ( elem, selector ) {

                // Element.matches() polyfill
                if (!Element.prototype.matches) {
                    Element.prototype.matches =
                        Element.prototype.matchesSelector ||
                        Element.prototype.mozMatchesSelector ||
                        Element.prototype.msMatchesSelector ||
                        Element.prototype.oMatchesSelector ||
                        Element.prototype.webkitMatchesSelector ||
                        function(s) {
                            var matches = (this.document || this.ownerDocument).querySelectorAll(s),
                                i = matches.length;
                            while (--i >= 0 && matches.item(i) !== this) {}
                            return i > -1;
                        };
                }
            
                // Get closest match
                for ( ; elem && elem !== document; elem = elem.parentNode ) {
                    if ( elem.matches( selector ) ) return elem;
                }
            
                return null;
            
            },
            isInViewport = function(elem) {
                let elementTop = elem.offset().top, 
                    elementBottom = elementTop + elem.outerHeight(),                
                    viewportTop = $(windowEl).scrollTop(),
                    viewportBottom = viewportTop - 200 + $(windowEl).height();
                
                return elementBottom > viewportTop && elementTop < viewportBottom;
            };
        
        
    const app = {        

        init: function() { 
                app.imageConversionFn();  
                //app.iframeFitVids(); 
                //app.headerActionReduceFn(); 
                app.headerActionFixedFn();  
                app.headerNavOutFixedFn();            
                app.heroCarouselFn(); 
                app.heroCarousel2Fn();  
                app.topSocialIconsActivate();    
                app.topHeaderSwitchingFn();       
                app.postNavsSizingFn();
                app.postMasonryFn();
                app.stickyWrapFn();
                app.revealTopSocial();
                app.reverseMenu($mainNavLis);
                app.postGalleryFn();
                app.revealSidePaginationFn();
                app.aosFn();
                app.videoAudioStylesFn();
                app.galleryModalFn();
                app.galleryPostCarouselFn();
                app.loadMorePostsFn();
                app.commentScrollFn();
                app.revealSideSocialsFn();
                app.socialWindowPopFn();
        },
        imageConversionFn:function(){
            let convertedImagesArray = [];

            convertedImagesArray = convertedImagesArray.concat(heroImagesArray, postGalleryImageContsArray,heroImages2Array,heroImages3Array);

            convertedImagesArray.map(function(convertedImage){
                imgToBg(convertedImage);
            });

        },
        iframeFitVids:function() {            
            iframeVidsArray.map(function(iframeVid){
                let iframeSrc = $(iframeVid).find('iframe').attr('src');

                console.log(iframeSrc);

                $(iframeVid).fitVids({
                     customSelector: "iframe[src^=" + iframeSrc + "]"
                });
                //$(iframeVid).fitVids();
            });
        },
        headerActionReduceFn:function(){
            if ( logoNavMiscHeaderEls.length ) { 
                            
                let headerHeight = logoNavMiscHeaderEls[0].offsetHeight,
                    currScrollPos = 0;

                let headerScroll = function() {
                    currScrollPos = windowEl.scrollY;
                    if (currScrollPos > headerHeight) {
                        logoNavMiscHeaderEls[0].classList.add('header-reduce');
                    } else {
                        logoNavMiscHeaderEls[0].classList.remove('header-reduce');
                    }
                }
                
                windowEl.addEventListener('load', headerScroll);             
                windowEl.addEventListener('scroll', headerScroll);
                windowEl.addEventListener('resize', headerScroll);
            }
        },        
        headerActionFixedFn:function(){
            let fixedHeaders = [];

            fixedHeaders = fixedHeaders.concat(navMiscHeaderElsArray);            

            if(fixedHeaders.length > 0){                

                fixedHeaders.map(function(fixedHeader){
                    let $fixedHeaderClone = $(fixedHeader).clone(),
                        $appendCont = $(mainHeader).parent(),
                        fixedHeaderHeight = fixedHeader.offsetHeight,
                        currScrollPos = 0;
                       
                    $appendCont.prepend($fixedHeaderClone);

                    let headerScroll = function() {
                        currScrollPos = windowEl.scrollY;
                        if (currScrollPos > fixedHeaderHeight) {
                            $appendCont.addClass('reveal-header');
                        } else {                            
                            $appendCont.removeClass('reveal-header');
                        }
                    }
                    
                    windowEl.addEventListener('load', headerScroll);             
                    windowEl.addEventListener('scroll', headerScroll);
                    windowEl.addEventListener('resize', headerScroll);

                    app.reverseMenu($('.nav-misc-h .main-nav li'));
                });
                
            }
        },
        headerNavOutFixedFn:function(){
            if(navOutHeader){
                let $stickyHeader = $('<div class="search-nav-mis-h logo-misc-h"/>'),
                    clonedSearchCol = $(searchCol).clone(),
                    clonedNavCol = $(navCol).clone(),
                    clonedMiscCol = $(miscCol).clone(),
                    $appendCont = $(mainHeader).parent(),
                    currScrollPos = 0,
                    navOutHeaderHeight = mainHeader[0].offsetHeight;


                    $appendCont.prepend($stickyHeader.append(clonedSearchCol,clonedNavCol,clonedMiscCol));

                let headerScroll = function() {
                    currScrollPos = windowEl.scrollY;
                    if (currScrollPos > navOutHeaderHeight) {
                        $appendCont.addClass('reveal-header');
                    } else {                            
                        $appendCont.removeClass('reveal-header');
                    }
                }
                
                windowEl.addEventListener('load', headerScroll);             
                windowEl.addEventListener('scroll', headerScroll);
                windowEl.addEventListener('resize', headerScroll);

                app.reverseMenu($('.search-nav-mis-h .main-nav li'));
            }
        },
        heroCarouselFn:function(){
            if(heroCarousels.length){
                heroCarouselsArray.map(function(heroCarousel){ 
                    $(heroCarousel).slick({
                        slidesToShow:1,                        
                        prevArrow:'<button type="button" class="slick-prev"></button>',
                        nextArrow:'<button type="button" class="slick-next"></button>', 
                        fade:true
                    });
                })
            }
        },
        heroCarousel2Fn:function(){
            let carosuelsArray = [];

                carosuelsArray = carosuelsArray.concat(heroCarousels2Array, heroCarousels3Array);

            if(carosuelsArray.length > 0){
                carosuelsArray.map(function(carosuel){ 
                    let $heroCarousel2 = $(carosuel),
                        heroCarouselParent = $heroCarousel2.parent(),
                        heroCarouselNavs = heroCarouselParent.find('.carousel-nav'),
                        currentSlideCont = heroCarouselParent.find('.carousel-counter-position'),
                        totalSlideCont = heroCarouselParent.find('.carousel-counter-total');

                    $heroCarousel2.slick({
                        slidesToShow:1,                        
                        prevArrow:$('.carousel-nav-prev'),
                        nextArrow:$('.carousel-nav-next'), 
                        fade:true
                    });

                    let slideCountFn = function(){
                        let totalSlide = $heroCarousel2.slick('getSlick').slideCount;
                        return totalSlide;
                    }

                    let currentSlideFn = function(){
                        let currentSlideIndex = $heroCarousel2.slick('slickCurrentSlide'),
                            currentSlide = currentSlideIndex + 1;
                        
                        if(currentSlide < 10 ) {
                            return '0' + currentSlide;
                        } else {
                            return currentSlide;
                        }
                    }

                    currentSlideCont.html(currentSlideFn);

                    totalSlideCont.html(slideCountFn);

                    if(slideCountFn() > 1) {
                        $(carouselPagination).addClass('active');                        
                    }

                    $heroCarousel2.on('afterChange', function(slick){                        
                        currentSlideCont.html(currentSlideFn);
                    }); 
                    
                });
            }
        },
        topSocialIconsActivate:function(){
            if(headerHeroDefault.length && heroRs.length) {
                let $fixedHeaderClone = $(logoNavMiscHeaderEls).clone(),
                    $appendCont = $(mainHeader).parent(),
                    mainHeroRsOffsetTop = $(heroRs).offset().top,
                    mainHeroRsHeight = heroRs[0].offsetHeight,
                    mainHeroRsBottom = mainHeroRsOffsetTop + mainHeroRsHeight,
                    currScrollPos = 0;
                       
                $appendCont.prepend($fixedHeaderClone);

                let headerScroll = function() {
                    currScrollPos = windowEl.scrollY;
                    
                    if (currScrollPos > mainHeroRsHeight) {
                        $appendCont.addClass('default-header-spacing');
                    } else {
                        $appendCont.removeClass('default-header-spacing');
                    }

                    if (currScrollPos > mainHeroRsBottom) {
                        $appendCont.addClass('show-top-icons');
                    } else {
                        $appendCont.removeClass('show-top-icons');
                    }
                }
                
                windowEl.addEventListener('load', headerScroll);             
                windowEl.addEventListener('scroll', headerScroll);
                windowEl.addEventListener('resize', headerScroll);

                app.reverseMenu($('.header-hero-holder > .logo-nav-misc-h .main-nav li'));
            }
        }, 
        topHeaderSwitchingFn:function(){
            if(fullPostHeaderEl.length && logoNavMiscHeaderEls.length) {
                let fullBlogPostHeadOffsetTop = $(fullBlogPostHead).offset().top,
                    fullBlogPostHeadHeight = fullBlogPostHead[0].offsetHeight,
                    fullBlogPostHeadBottom = fullBlogPostHeadOffsetTop + fullBlogPostHeadHeight,
                    currScrollPos = 0,
                    prevScrollPos = 0;

                let blogScroll = function() {
                    currScrollPos = windowEl.scrollY;
                    
                    if(currScrollPos > fullBlogPostHeadBottom){
                        $(bodyEl).addClass('switch-header');

                        if(prevScrollPos > currScrollPos){
                            $(bodyEl).addClass('inv-switch-header').removeClass('switch-header');
                        } else {
                            $(bodyEl).removeClass('inv-switch-header')
                        }
                        prevScrollPos = currScrollPos;
                    } else {
                        $(bodyEl).removeClass('switch-header inv-switch-header');
                    }
                }
                
                windowEl.addEventListener('load', blogScroll);             
                windowEl.addEventListener('scroll', blogScroll);
                windowEl.addEventListener('resize', blogScroll);
            }
        },
        postNavsSizingFn:function(){
            if(frPostNavs.length){
                frPostNavsArray.map(function(frPostNav){
                    let frPostNavLinks = frPostNav.querySelectorAll('a'),
                        frPostNavLinksArray = Array.apply(null,frPostNavLinks);

                    frPostNavLinksArray.map(function(frPostNavLink){
                        let frPostNavLinkW = $(frPostNavLink).outerWidth(),
                            frPostNavLinkH = $(frPostNavLink).outerHeight();

                            frPostNavLink.setAttribute('style', 'height:' + frPostNavLinkH + 'px; width:' + frPostNavLinkW + 'px');

                            $(frPostNavLink).closest('.fr-posts-nav').css('width', frPostNavLinkH + 'px');
                    });
                });
            }
        },       
        postMasonryFn:function(){
            if(masonryGrids.length){
                masonryGridsArray.map(function(masonryGrid){
                    let blogPostEl = '.blog-post',
                        columnWidthSize = '.grid-sizer',
                        gutterSizer = '.gutter-sizer',
                        msnry = new Masonry( masonryGrid, {
                            itemSelector: blogPostEl,
                            columnWidth: columnWidthSize,
                            gutter: gutterSizer,
                            percentPosition: true
                        });

                    
                    imagesLoaded(masonryGrid).on( 'progress', function() {                            
                        msnry.layout();
                    });                   

                });
            }
        },
        stickyWrapFn:function(){
            if(stickyWraps.length){
                $(stickyWraps).theiaStickySidebar({                
                    additionalMarginTop: 30
                });
            }
        },
        revealTopSocial:function(){            
            if(topSocialIcons){
                topSocialIconsArray.map(function(topSocialIcon){
                    let topSocialIconI = topSocialIcon.querySelector('i'),
                        topSocialIconUl = topSocialIcon.querySelector('ul');

                    if(topSocialIconI)
                    topSocialIconI.addEventListener('click', function(){                         
                        $(this).closest(topSocialIcon).toggleClass('reveal');
                    });
                })
            }
        },
        reverseMenu:function(ele){            
            ele.each(function(){
                let $mainNavLi = $(this),
                    childUl =  $mainNavLi.children('ul'),
                    mainNavLiString = '.main-nav li a';

                if(childUl.length) {

                    $(document).on('mouseenter',mainNavLiString,function(){
                        let windowWidth = $(windowEl).width(),
                            childUlOffestL = childUl.offset().left,
                            childUlWidth = childUl.outerWidth(),
                            totalOffsetLength = childUlOffestL + childUlWidth;

                            if(totalOffsetLength > windowWidth ){
                                childUl.addClass('rev-position');
                            }
                    });

                    $(document).on('mouseleave',mainNavLiString,function(){
                        childUl.removeClass('rev-position');
                    });
                }
            });            
        },
        postGalleryFn:function(){
            if(postGallerys.length) {
                postGallerysArray.map(function(postGallery){
                    $(postGallery).slick({
                        slidesToShow:1,
                        prevArrow:'<button type="button" class="slick-prev"></button>',
                        nextArrow:'<button type="button" class="slick-next"></button>',
                        appendArrows:$('.post-gallery-arrows'),                      
                    });
                });
            }
        },
        revealSidePaginationFn:function(){
            if(sidePaginationEnabled.length) {
                let $contentAreaIn = $(contentAreaIn),
                    contentAreaInTopPosition = $contentAreaIn.offset().top,
                    $mainFooter = $(mainFooter),
                    currScrollPos = 0;

                let pageScroll = function() {
                    currScrollPos = windowEl.scrollY;
                    
                    if (currScrollPos+200 > contentAreaInTopPosition && !(isInViewport($mainFooter)) ) {
                        $contentAreaIn.addClass('reveal-side-pagination');
                    } else {
                        $contentAreaIn.removeClass('reveal-side-pagination');
                    }
                }
                
                windowEl.addEventListener('load', pageScroll);             
                windowEl.addEventListener('scroll', pageScroll);
                windowEl.addEventListener('resize', pageScroll);


            }
        },
        aosFn:function(){
            if(jsAos.length){
                let delayVal = 0;

                jsAosArray.map(function(jsAosEl){
                    $(jsAosEl).attr('data-aos-delay',delayVal);
                });

                AOS.init({
                    easing: 'ease-out-back',
                });
            }
        },
        videoAudioStylesFn:function(){
            if( $videoAudioEls.length ){
                $videoAudioEls.mediaelementplayer();
            }
        },
        galleryModalFn:function(){
            if( galleryModalCont.length ){
                $(galleryModalTrigger).on('click',function(e){
                    e.preventDefault();
                    $(galleryModalCont).addClass('open-modal')
                });

                $(galleryModalClose).on('click',function(){                  
                    $(galleryModalCont).removeClass('open-modal view-all-grid')
                });
            }
        },        
        galleryPostCarouselFn:function(){
            if(gallerypostCarousel.length){

                modalGridMasonryArray.map(function(modalmasonryGrid){
                    let galleryGridEl = singleGridImgString,
                        columnWidthSize = '.modal-grid-sizer',
                        gutterSizer = '.modal-gutter-sizer',
                        msnry = new Masonry( modalmasonryGrid, {
                            itemSelector: galleryGridEl,
                            columnWidth: columnWidthSize,
                            gutter: gutterSizer,
                            percentPosition: true
                        });
                    
                    imagesLoaded(modalmasonryGrid).on( 'progress', function() {                            
                        msnry.layout();
                    });
                });

                $(viewAllGrids).on('click',function(){
                    $(galleryModalCont).toggleClass('view-all-grid');
                });
                
                $(gallerypostCarousel).slick({
                    slidesToShow:1,                       
                    prevArrow:$('.prev-gmn'),
                    nextArrow:$('.next-gmn')
                });

                let checkCaption = function(){
                    let currentSlideIndex = $(gallerypostCarousel).slick('slickCurrentSlide'),
                        slickSlide = $(gallerypostCarousel).find('.slick-slide'),
                        slickSlideSelected = $(slickSlide).filter(function(){
                            return $(this).attr('data-slick-index') == parseInt(currentSlideIndex)
                        }),
                        selectedImage = $(slickSlideSelected).find('.single-gmc-image');

                        if( selectedImage[0].hasAttribute('data-gmc-caption') ){
                            let getCaption = selectedImage.attr('data-gmc-caption');
                            $(captionContainer).parent().addClass('active');
                            $(captionContainer).html(getCaption);
                        } else {
                            $(captionContainer).parent().removeClass('active');
                        }
                }

                checkCaption();

                let slideCountFn = function(){
                    let totalSlide = $(gallerypostCarousel).slick('getSlick').slideCount;

                    if(totalSlide < 10 ) {
                        return '0' + totalSlide;
                    } else {
                        return totalSlide;
                    }                    
                }

                let currentSlideFn = function(){
                    let currentSlideIndex = $(gallerypostCarousel).slick('slickCurrentSlide'),
                        currentSlide = currentSlideIndex + 1;
                    
                    if(currentSlide < 10 ) {
                        return '0' + currentSlide;
                    } else {
                        return currentSlide;
                    }
                }

                $(galleryCounterPosition).html(currentSlideFn);
                $(galleryCounterTotal).html(slideCountFn);

                if(slideCountFn() > 1) {
                    $(galleryModalNav).addClass('active');                   
                }                

                $(singleGridImgString).on('click', 'img', function(){
                    let parentIndex = parseInt($(this).parent().attr('data-grid-count'));   
                    
                    $(galleryModalCont).removeClass('view-all-grid');

                    $(gallerypostCarousel).slick('slickGoTo',parentIndex,true);                    
                });

                $(gallerypostCarousel).on('afterChange', function(slick){
                    checkCaption(); 
                    $(galleryCounterPosition).html(currentSlideFn);
                }); 
                
                
            }
        },
        loadMorePostsFn:function(){
            if( loadMoreButton.length ){
                $(loadMoreButton).on( 'click', function(){

                    let button = $(this),
                        pageLink = window.location.href,
                        newUrl,
                        spinner = $(this).find('.spinner'),
                        data = {
                            'action': 'loadmore',
                            'query': taarifa_wp_localize.posts,
                            'page' : taarifa_wp_localize.current_page
                        };
                        
                    $.ajax({
                        url : taarifa_wp_localize.ajaxurl, // AJAX handler
                        data : data,
                        type : 'POST',
                        beforeSend : function ( xhr ) { 
                            button.text( taarifa_wp_localize.loading_text ).prepend($(spinner).addClass('unpause')); 
                        },
                        success : function( data ){
                            if( data ) { 
                                button.text( taarifa_wp_localize.more_post_text ).prepend($(spinner).removeClass('unpause')); 
                                $(postsCont).append(data);
                                app.postMasonryFn();
                                app.aosFn();                           
                               
                                taarifa_wp_localize.current_page++;    
                               /*  
                               // Uncomment if you want to create urls
                               if(pageLink.lastIndexOf('page/') !== -1){ 
                                   newUrl = pageLink.split('page/')[0] + 'page/' + taarifa_wp_localize.current_page;
                                }else {
                                    newUrl = 'page/' + taarifa_wp_localize.current_page;
                                } 
                                history.pushState(null,null,newUrl)
                                */
                                if ( taarifa_wp_localize.current_page == taarifa_wp_localize.max_page ) 
                                    button.remove().find('.spinner').removeClass('unpause'); 
                            } else {
                                button.remove().find('.spinner').removeClass('unpause'); 
                            }
                        }
                    });
                });
            }
            
        },
        commentScrollFn:function(){
            if( commentScrollSection.length && commentScroll.length ) {
                let commentScrollSectionTop = $(commentScrollSection).offset().top;

                $(commentScroll).on('click', function(e) {
                    let commentLink = $(this).attr('href');

                    e.preventDefault();

                    $('html,body').stop().animate({scrollTop:commentScrollSectionTop - 80});
                    history.pushState(null,null,commentLink);
                });
            }
        },
        revealSideSocialsFn:function(){
            if( postsSocialShare.length ) {
                let $mainFooter = $(mainFooter),
                    currScrollPos = 0;

                let pageScroll = function() {
                    currScrollPos = windowEl.scrollY;
                    
                    if (currScrollPos+150 && (isInViewport($mainFooter)) ) {
                        $(postsSocialShare).addClass('hide-side-social');
                    } else {
                        $(postsSocialShare).removeClass('hide-side-social');
                    }
                }
                
                windowEl.addEventListener('load', pageScroll);             
                windowEl.addEventListener('scroll', pageScroll);
                windowEl.addEventListener('resize', pageScroll);
            }
        },
        socialWindowPopFn:function(){
            if( postsSocialShare.length ){
                let socialShareTriggers = $(postsSocialShare).find('a');

                socialShareTriggers.on('click',function(e){
                    e.preventDefault();
                    let socialShareLink = $(this).attr('href'),
                        socialWindow = window.open(
                            socialShareLink,
                            '',
                            'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'
                        );
                        return false;
                });
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        app.init();
    });

})(jQuery);
