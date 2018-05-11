jQuery.adminSearchFreelancer = {
    settings: {
        skillset: [],
        city: '',
    },
    wrapper: {
        $input: jQuery('#input-search-freelancer'),
        $button: jQuery('#button-search-freelancer'),
        $result: jQuery('#search-results'),
        $spinner: jQuery('#spinner')
    },
    init: function() {
        var self = this;
        self.setEvent();
        $('.select2').select2({
            placeholder: 'Silahkan Pilih Skill'
        });
        $('#slimScroll').slimScroll({
            height: '500px'      
        });
    },
    approveOrReject: function(url, $selector){
        var self = this;

        $.get(url).done( function ( response ) {

            $.ajax({
                url : window.location.href,
                dataType: 'json',
                beforeSend: function() {
                    self.wrapper.$result.hide();
                    self.wrapper.$spinner.css({'height': '100px'});
                    jQuery(window).scrollTop(0);
                }
            }).done(function (data) {
                swal('Success', response['message'], response['status']);
            
                self.wrapper.$result.show().html(data);
                self.wrapper.$spinner.css({'height': '0px'});
            }).fail(function () {
    
                swal('Error','Search could not be loaded.', 'error');
            });
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

                var data = {
                    q: self.wrapper.$input.val(),
                };
                if (self.settings.city) {
                    data['city'] = self.settings.city;
                }
                if (jQuery('#skill').val()) {
                    data['skill'] = jQuery('#skill').val();
                }
                var ajax = $.ajax({
                    url: 'browse-freelancer',
                    data: data,
                    type: 'post'
                });

                ajax.done(function (data){
                    
                    self.wrapper.$result.show().html(data);
                    window.history.pushState(null, null, '/browse-freelancer?q=' + self.wrapper.$input.val());
                    self.wrapper.$spinner.css({'height': '0px'});
                    jQuery('.pagination').attr('id', 'pagination');
                    
                })
                
                ajax.fail(function (jqXHR, textStatus) {
                    swal('Error', 'Ada yang tidak beres!.', 'error');
                });

            }
        });

        jQuery('#city').on('change', function() {
            var ini = self.settings;
            var city=$(this).select2('data');
            
            if (city && city.text != 'Tetapkan Lokasi') {
                var text = city.text;
                var location = text.replace(/\s+/g, " ").trim();
                ini.city = location;
            }
        });

        jQuery(document).on('click', '#approve-button', function () {
            var $btn        = $(this);
            var member_id   = $btn.attr('member-id');
            var url         = 'members/approve/'+member_id;
            $btn.button('loading');
            self.approveOrReject(url, $btn);
        });

        jQuery(document).on('click', '#reject-button', function () {
            var $btn        = $(this);
            var member_id   = $btn.attr('member-id');
            var url         = 'members/reject/'+member_id;
            $btn.button('loading');
            self.approveOrReject(url, $btn);
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
            }).done(function (data) {
    
                self.wrapper.$result.show().html(data);
                window.history.pushState(null, null, '/browse-freelancer?page=' + pages.split('page=')[1]);
                self.wrapper.$spinner.css({'height': '0px'});
            }).fail(function () {
    
                swal('Error','Search could not be loaded.', 'error');
            });
        });
    },
    getSearch: function(page) {
        var self = this;

        $.ajax({
            url : page,
            dataType: 'json',
        }).done(function (data) {

            self.wrapper.$result.show().html(data);
            window.history.pushState(null, null, '/browse-freelancer?q=' + page.split('q=')[1]);
            self.wrapper.$spinner.css({'height': '0px'});
            jQuery('.pagination').attr('id', 'pagination');
        }).fail(function () {

            swal('Error','Search could not be loaded.', 'error');
        });
    }
};

jQuery(document).ready( function() {
    jQuery.adminSearchFreelancer.init();
  });  