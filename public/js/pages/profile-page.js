jQuery.editProfile = {
  data: {
    portofolio: {
      id: '',
      item: {},
      collection: {}
    },
    profile: {}
  },
  wrapper: {
    portofolio: {
      $modalportofolio: jQuery('#modal-portofolio'),
      $btnEditportofolio: jQuery('#edit-portofolio'),
      $btnShowportofolio: jQuery('.portofolios #show-portofolio'),
      $btnAddportofolio: jQuery('#add-portofolio'),
      $saveportofolio: jQuery('#save-button-portofolio'),
      $updateportofolio: jQuery('#update-button-portofolio'),
      $closeportofolio: jQuery('#close-portofolio-modal'),
      $closeDetPort: jQuery('#close-portofolio'),
      $modalDetPort: jQuery('#portofolio-details'),
      $portofolioForm: jQuery('#portofolio-form')[0],
      $endDateMonth: jQuery('#end-date-month'),
      $endDateYear: jQuery('#end-date-year'),
      $startDateYear: jQuery('#start-date-year'),
      $startDateMonth: jQuery('#start-date-month'),
      $btnProjectOnGoing: jQuery('.project-ongoing #project-ongoing')
    },
    profile: {
      $modalProfile: jQuery('#modal-profile'),
      $saveProfile: jQuery('#save-button-profile'),
      $closeProfile: jQuery('#close-modal'),
      $btnEditProfile: jQuery('#edit-profile'),
      $skillSet: jQuery('#skill-set'),
    }
  },
  $body: jQuery('#profile'),
  init: function() {
    var self = this;
    self.wrapper.profile.$skillSet.select2({ tags: true });
    self.setEvent();
    self.profile();
    self.portofolio();
    self.showportofolioItem();
  },
  profile: function() {
    var self = this;
    self.wrapper.profile.$btnEditProfile.click(() => {
      self.wrapper.profile.$modalProfile.css({'display': 'block'});
      self.$body.css({'overflow': 'hidden'});
    });

    self.wrapper.profile.$closeProfile.click(() => {
      self.wrapper.profile.$modalProfile.css({'display': 'none'});
      self.$body.css({'overflow': 'auto'});
    });

    self.wrapper.profile.$saveProfile.click(() => {
      var object = { skill_set_name: self.wrapper.profile.$skillSet.val() };
      var form = $('#profile-form').serializeArray();
      _.forEach(form, function(el, i){
        object[el.name] = el.value;
      });

      jQuery.ajax({
        url: 'profile',
        type: 'PATCH',
        data: object,
        success: function(response) {
          window.location.reload();
          self.wrapper.profile.$modalProfile.css({'display': 'none'});
        },
        error: function(xhr,status, response){
          var error = jQuery.parseJSON(xhr.responseText);
          for(var k in error.errors){
            if(error.errors.hasOwnProperty(k)){
                error.errors[k].forEach(function(val){
                    $.notify(""+val+"");
                });
              }
            }
          }
      });
    });
  },
  portofolio: function() {
    var self = this;

    self.wrapper.portofolio.$btnAddportofolio.click(function(event) {
      self.wrapper.portofolio.$saveportofolio.show();
      self.wrapper.portofolio.$updateportofolio.hide();
      self.wrapper.portofolio.$modalportofolio.css({'display': 'block'});
      self.$body.css({'overflow': 'hidden'});
    });

    self.wrapper.portofolio.$closeportofolio.click(function(event) {
      self.wrapper.portofolio.$endDateMonth.removeClass('disabled').attr('disabled', false);
      self.wrapper.portofolio.$endDateYear.removeClass('disabled').attr('disabled', false);
      self.wrapper.portofolio.$portofolioForm.reset();
      self.wrapper.portofolio.$modalportofolio.css({'display': 'none'});
      self.$body.css({'overflow': 'auto'});
    });

    self.wrapper.portofolio.$btnEditportofolio.click(function(event) {
      self.wrapper.portofolio.$saveportofolio.hide();
      self.wrapper.portofolio.$updateportofolio.show();
      self.wrapper.portofolio.$modalDetPort.css({'display': 'none'});
      self.$body.css({'overflow': 'auto'});

      async.waterfall([
        function(callback) {
          var id = self.data.portofolio.id;
          var url = 'portofolio/'+id;
          jQuery.get(url, function(response) {
            jQuery('#project-name').val(response.portofolio.project_name);
            jQuery('#project-url').val(response.portofolio.project_url);
            jQuery('#description').val(response.portofolio.description);
            if(response.portofolio.project_on_going == 1)
            {
              self.wrapper.portofolio.$btnProjectOnGoing.prop('checked', true);
              self.wrapper.portofolio.$startDateMonth.val(response.start_date_month);
              self.wrapper.portofolio.$startDateYear.val(response.start_date_year);
              self.wrapper.portofolio.$endDateMonth.addClass('disabled').attr('disabled', true);
              self.wrapper.portofolio.$endDateYear.addClass('disabled').attr('disabled', true);
            } 
            else 
            {
              self.wrapper.portofolio.$btnProjectOnGoing.prop('checked', false);
              self.wrapper.portofolio.$startDateMonth.val(response.start_date_month);
              self.wrapper.portofolio.$startDateYear.val(response.start_date_year);
              self.wrapper.portofolio.$endDateMonth.val(response.end_date_month);
              self.wrapper.portofolio.$endDateYear.val(response.end_date_year);
            }
            self.wrapper.portofolio.$modalportofolio.css({'display': 'block'});
            self.$body.css({'overflow': 'hidden'});
            callback(null, true);
          });
        }
      ]);
    });

    self.wrapper.portofolio.$btnProjectOnGoing.change(function() {
      if(this.checked){
        self.wrapper.portofolio.$endDateMonth.addClass('disabled').attr('disabled', true);
        self.wrapper.portofolio.$endDateYear.addClass('disabled').attr('disabled', true);
      } else {
        self.wrapper.portofolio.$endDateMonth.removeClass('disabled').attr('disabled', false);
        self.wrapper.portofolio.$endDateYear.removeClass('disabled').attr('disabled', false);
      }
    });

    self.wrapper.portofolio.$saveportofolio.click(function(event) {
      event.preventDefault();
      var url = 'portofolio';
      self.postPortofolio(url);
    });

    self.wrapper.portofolio.$updateportofolio.click(function(event) {
      event.preventDefault();
      var url = 'portofolio/'+self.data.portofolio.id;
      self.postPortofolio(url);
    });
  },
  showportofolioItem: function() {
    var self = this;

    self.wrapper.portofolio.$btnShowportofolio.click( function() {
      self.data.portofolio.id = $(this).attr('data-portofolio-id');
      self.wrapper.portofolio.$modalDetPort.css({'display': 'block'});
      self.$body.css({'overflow': 'hidden'});
    });
    self.wrapper.portofolio.$closeDetPort.click( function() {
      self.wrapper.portofolio.$modalDetPort.css({'display': 'none'});
      self.$body.css({'overflow': 'auto'});
    });
  },
  setEvent: function() {
    var self = this;

    jQuery(window).click( function(event) {
      if (event.target == self.wrapper.portofolio.$modalProfile) {
        self.$modalProfile.css({'display': 'none'});
        self.$body.css({'overflow': 'auto'});
      }
      if (event.target == self.wrapper.portofolio.$modalportofolio) {
        self.wrapper.portofolio.$modalportofolio.css({'display': 'none'});
        self.$body.css({'overflow': 'auto'});
        }
      if (event.target == self.wrapper.portofolio.$modalDetPort) {
        self.wrapper.portofolio.modalDetPort.css({'display': 'none'});
        self.$body.css({'overflow': 'auto'});
      }
    });
  },
  postPortofolio: function(url){
    var object = {
      thumbnail: jQuery('#upload-portofolio-img').prop('files')[0],
      member_id: parseInt(jQuery('#member-id').val()),
      project_on_going: ''
    };

    if(jQuery('.project-ongoing #project-ongoing').is(':checked')){
      object.project_on_going = 1;
    } else {
      object.project_on_going = 0;
    }

    var form = jQuery('#portofolio-form').serializeArray();
    var formData = new FormData();
    formData.append('thumbnail', object.thumbnail);
    formData.append('member_id', object.member_id);
    formData.append('project_on_going', object.project_on_going);
    _.forEach(form, function(el, i){
      formData.append(el.name, el.value);
    });

    jQuery.ajax({
      url: url,
      data: formData,
      method: 'POST',
      contentType: false,
      processData: false,
      success: function(response) {
        window.location.reload();
        self.wrapper.portofolio.$modalportofolio.css({'display': 'none'});
        self.$body.css({'overflow': 'auto'});
      },
      error: function(xhr,status, response){
        var error = jQuery.parseJSON(xhr.responseText);
        for(var k in error.errors){
          if(error.errors.hasOwnProperty(k)){
              error.errors[k].forEach(function(val){
                  $.notify(""+val+"");
              });
            }
          }
      }
    });
  }
};

jQuery(document).ready(() => {
  jQuery.editProfile.init();
});
