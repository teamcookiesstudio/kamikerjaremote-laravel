jQuery.adminSearchFreelancer = {
    wrapper: {
        $input: jQuery('#input-search-freelancer'),
        $button: jQuery('#button-search-freelancer'),
        $result: jQuery('#search-results'),
        $spinner: jQuery('#spinner')
    },
    init: function() {
        var self = this;
        self.setEvent();
        $.get('skill-sets/data').done(function(data) { self.bloodhound(data); });
        $('#slimScroll').slimScroll({
            height: '500px'      
        });
    },
    approveOrReject: function(url, $selector){
        var self = this;

        $.get(url).done( function ( response ) {
            swal('Success', response['message'], response['status']);
            $selector.button('reset');
        });
    },
    setEvent: function() {
        var self = this;

        self.wrapper.$button.click(function (e) {
            e.preventDefault();
            
            if (_.isEmpty(self.wrapper.$input.val())) {

                swal('Error', 'Kolom pencarian tidak boleh kosong..', 'error');
            } else {

                self.wrapper.$result.hide();
                self.wrapper.$spinner.css({'height': '100px'});
                jQuery(window).scrollTop(0);

                var q = self.wrapper.$input.val();
                var ajax = $.ajax({
                    url: 'browse-freelancer',
                    cache: true,
                    data: {q: q}
                });

                ajax.done(function (data){
                    
                    self.wrapper.$result.show().html(data);
                    window.history.pushState(null, null, '/browse-freelancer?q=' + q);
                    self.wrapper.$spinner.css({'height': '0px'});
                    jQuery('.pagination').attr('id', 'pagination');
                    
                })
                
                ajax.fail(function (jqXHR, textStatus) {
                    swal('Error', 'Ada yang tidak beres!.', 'error');
                });

            }
        });

        jQuery(document).on('click', '#approve-button', function () {
            var $btn        = $(this);
            var member_id   = $btn.attr('member_id');
            var url         = 'members/approve/'+member_id;
            $btn.button('loading');
            self.approveOrReject(url, $btn);
        });

        jQuery('#reject-button').click(function () {
            var $btn        = $(this);
            var member_id   = $btn.attr('member-id');
            var url         = 'members/reject/'+member_id;
            $btn.button('loading');
            approveOrReject(url, $btn);
        });

        jQuery(document).on('click', '#pagination a', function (e) {
            
            self.getSearch($(this).attr('href'));
            self.wrapper.$result.hide();
            self.wrapper.$spinner.css({'height': '100px'});
            $(window).scrollTop(0);
            e.preventDefault();
        });

        jQuery(document).on('click', '#test a', function (e) {

            var pages = $(this).attr('href');
            self.wrapper.$result.hide();
            self.wrapper.$spinner.css({'height': '100px'});
            $(window).scrollTop(0);
            e.preventDefault();

            $.ajax({
                url : pages,
                dataType: 'json',
                cache: true,
            }).done(function (data) {
    
                self.wrapper.$result.show().html(data);
                window.history.pushState(null, null, '/browse-freelancer?page=' + pages.split('page=')[1]);
                self.wrapper.$spinner.css({'height': '0px'});
            }).fail(function () {
    
                swal('Error','Search could not be loaded.', 'error');
            });
        })
    },
    getSearch: function(page) {
        var self = this;

        $.ajax({
            url : page,
            dataType: 'json',
            cache: true,
        }).done(function (data) {

            self.wrapper.$result.show().html(data);
            window.history.pushState(null, null, '/browse-freelancer?q=' + page.split('q=')[1]);
            self.wrapper.$spinner.css({'height': '0px'});
            jQuery('.pagination').attr('id', 'pagination');
        }).fail(function () {

            swal('Error','Search could not be loaded.', 'error');
        });
    },
    bloodhound: function(data) {
        var skillsets = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('skill_set_name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: data
        });
        skillsets.initialize();
        
        var elt = $('#skill-set');
        elt.tagsinput({
            itemValue: 'id',
            itemText: 'skill_set_name',
            typeaheadjs: {
                name: 'skillsets',
                displayKey: 'skill_set_name',
                source: skillsets.ttAdapter()
            }
        });
    }
};

jQuery(document).ready( function() {
    jQuery.adminSearchFreelancer.init();
  });  