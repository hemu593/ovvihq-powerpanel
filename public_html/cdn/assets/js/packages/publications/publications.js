$(document).on("click", '.ac-pagination li a', function(event) {
    event.preventDefault();
    var $this = $(this);
    var pagginationUrl = $this.attr('href');

    var monthid = "";
    var yearid = "";

    $.ajax({
        type: 'GET',
        start: SetBackGround(),
        //url: ajaxModuleUrl + "?page=" + pageNumber,
        url: pagginationUrl,
        dataType: "json",
        success: function(data) {
            UnSetBackGround();
            //pageNumber += 1;
            if (data.length == 0) {} else {
                $('.section_node').html(data.html);
                //$(data.html).insertAfter($('.section_node').last());
                $("#custompagination").html(data.paginationHtml);
            }

        },
        complete: function() {},
        error: function(data) {
            console.log('error!', err);
        },
    });
});

var c = parseInt(Limits);
$(document).on("click", '#paginationLink li a', function(event) {
    let pageNumber = $(this).data('page')
    let title = $(this).attr('title')
    if (pageNumber != null && pageNumber != '') {
        var urlParam = pageNumber.split("?")[1];
        var params = urlParam.split("=")[1];
        var list = $('#paginationLink li')
        for (var i = 0; i < list.length; i++) {
            $(list[i]).removeClass('active')
            if ($(list[i].getElementsByTagName("a")).attr('title') == params) {
                $(list[i]).addClass('active')
            }
        }
        // getFilterData(params)
        c += parseInt(Limits);
        getFilterData(1, c);
    }

})

// year filter
$(document).on("click", '#yearFilter li input', function(event) {
    // $('#yearFilter li input[type=checkbox]:checked').each(function() {
    getFilterData()
        // });

});

$(document).on("change", '#categoryFilter', function(event) {
    event.preventDefault();
    getFilterData()
});

function getFilterData(pageNumber = 1, Limits) {
    let category = $('#categoryFilter').find(":selected").val();
    let year = []
    $('#yearFilter li input[type=checkbox]:checked').each(function() {
        year.push($(this).val())
    });
    var ajaxurl = site_url + '/' + slug + '/fetchdata';

    $.ajax({
        url: ajaxurl,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {

            pageName: pagename,
            category: category,
            limits: Limits,
            sector: publicationsector,
            pageNumber: pageNumber,
            year: year

        },
        type: "POST",
        dataType: "json",
        success: function(data) {

            console.log('resp', data)
            if (data.response == '') {
                document.getElementById('pageContent').innerHTML = `<div class="row">
                <div class="col-12 text-center" data-aos="fade-up">
                    <div class="nqtitle n-fw-800 n-lh-110 text-uppercase">No data found</div>
                    <div class="desc n-fs-20 n-fw-500 n-lh-130">Please reset filter or load page to see the data.</div>
                </div>  
            </div>`
            } else {

                document.getElementById('pageContent').innerHTML = data.response
            }
            aosFunction();
            svgIcon(".n-icon");
        },
        complete: function() {},
        error: function(err) {
            console.log('error!', err);
        }
    });
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function setDocumentHitCounter(docId, counterType) {
    if (docId != null) {

        $.ajax({
            type: 'POST',
            url: site_url + "/setDocumentHitcounter",
            data: {
                "docId": docId,
                "counterType": counterType
            },
            success: function(data) {

            },
            complete: function() {

            },
            error: function(data) {},
        });

    }
}

$(document).on("click", ".docHitClick", function() {
    var docViewId = $(this).data('viewid');
    var docViewType = $(this).data('viewtype');

    if (docViewId != "" && docViewType != "") {
        setDocumentHitCounter(docViewId, docViewType);
    }
});