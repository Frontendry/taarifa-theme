// Main App Funcs
(function($) {
    "use strict";

    const   windowEl = window, 
            bodyEl = document.body,
            reduxSidebar = document.querySelectorAll('.redux-sidebar'),
            reduxMain = document.querySelectorAll('.redux-main');

    const app = {        

        init: function() { 
            app.reduxStickyColumn();                
        },
        reduxStickyColumn:function(){
            if(reduxSidebar.length && reduxMain.length ) {
                let reduxContainers = $(reduxSidebar).add(reduxMain);

                reduxContainers.wrapAll('<div class="redux-cont-wrap"/>');

                reduxContainers.wrapInner('<div class="theiaStickySidebar"/>');

                $(reduxContainers).theiaStickySidebar({                
                    additionalMarginTop: 32
                });
            }
        }     
    }

    document.addEventListener('DOMContentLoaded', function () {
        app.init();
    });

})(jQuery);
