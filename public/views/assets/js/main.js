$(document).ready(function() {
    addBorderErrorColor();
    removeBorderErrorColor();
    $("div.blog-post").hover(
        function() {
            $(this).find("div.content-hide").slideToggle("fast");
        },
        function() {
            $(this).find("div.content-hide").slideToggle("fast");
        }
    );

    $('.flexslider').flexslider({
        prevText: '',
        nextText: ''
    });

    $('.testimonails-slider').flexslider({
        animation: 'slide',
        slideshowSpeed: 5000,
        prevText: '',
        nextText: '',
        controlNav: false
    });
    $(function() {
        // Instantiate MixItUp:

        $('#Container').mixItUp();
        $(document).ready(function() {
            $(".fancybox").fancybox();
        });

    });
});

function addBorderErrorColor() {
    var form = document.forms;
    if (form.length > 0) {
        for (let i = 0; i < form.length; i++) {
            if (form[i].className != 'subscribeForm') {
                let inputs = form[i].getElementsByTagName(['input']);

                for (let j = 0; j < inputs.length; j++) {
                    if (inputs[j].type.toLowerCase() === "password" || inputs[j].type.toLowerCase() === "text") {
                        let error = inputs[j].nextElementSibling.innerHTML;
                        if (error != '') {
                            inputs[j].classList.add("border-danger");
                        }
                    }
                }
            }
        }
    }
}

function removeBorderErrorColor() {
    var form = document.forms;
    if (form.length > 0) {
        for (let i = 0; i < form.length; i++) {
            if (form[i].className != 'subscribeForm') {
                let inputs = form[i].getElementsByTagName(['input']);
                for (let j = 0; j < inputs.length; j++) {
                    if (inputs[j].type.toLowerCase() === "password" || inputs[j].type.toLowerCase() === "text") {
                        inputs[j].addEventListener('change', (event) => {
                            event.preventDefault;
                            inputs[j].classList.remove("border-danger");
                        });
                    }
                }
            }
        }
    }
}