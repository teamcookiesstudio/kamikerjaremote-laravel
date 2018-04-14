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
    var memberId = jQuery('#member-id').val();
    var url = 'portofolio/'+memberId;
    $.get(url, function(response) {
      self.data.portofolio.collection = response;
    });
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

      var id = self.data.portofolio.id;
      var data = _.find(self.data.portofolio.collection, {id: parseInt(id)});

      jQuery('#project-name').val(data.project_name);
      jQuery('#project-url').val(data.project_url);
      jQuery('#description').val(data.description);

      var initStartDate = self.initDate(data.start_date);
      var initEndDate = self.initDate(data.end_date);

      if(data.project_on_going){
        self.wrapper.portofolio.$btnProjectOnGoing.prop('checked', true);
        self.wrapper.portofolio.$startDateMonth.val(initStartDate.month);
        self.wrapper.portofolio.$startDateYear.val(initStartDate.year);
        self.wrapper.portofolio.$endDateMonth.addClass('disabled').prop('disabled', true);
        self.wrapper.portofolio.$endDateYear.addClass('disabled').prop('disabled', true);
      } else {
        self.wrapper.portofolio.$btnProjectOnGoing.prop('checked', false);
        self.wrapper.portofolio.$startDateMonth.val(initStartDate.month);
        self.wrapper.portofolio.$startDateYear.val(initStartDate.year);
        self.wrapper.portofolio.$endDateMonth.val(initEndDate.month);
        self.wrapper.portofolio.$endDateYear.val(initEndDate.year);
      }
      self.wrapper.portofolio.$modalportofolio.css({'display': 'block'});
      self.$body.css({'overflow': 'hidden'});
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

      var id = self.data.portofolio.id;
      var data = _.find(self.data.portofolio.collection, {id: parseInt(id)});
      var initStartDate = self.initDate(data.start_date);
      var initEndDate = self.initDate(data.end_date);

      jQuery('#portofolio-item-project-name').text(data.project_name);
      jQuery('#portofolio-item-description').text(data.description);
      jQuery('#portofolio-item-image').attr('src', 'storage/portofolio/'+data.thumbnail);
      jQuery('#portofolio-item-project-url').text(data.project_url).attr('href', data.project_url);
      if(data.project_on_going){
        jQuery('#portofolio-item-project-date').text(initStartDate.year+' '+initStartDate.month+' - '+'Project On Going');
      } else {
        jQuery('#portofolio-item-project-date').text(initStartDate.year+' '+initStartDate.month+' - '+initEndDate.year+' '+initEndDate.month);
      }
      
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
  },
  initMonths: function() {
    var month = new Array();
        month[0] = "January";
        month[1] = "February";
        month[2] = "March";
        month[3] = "April";
        month[4] = "May";
        month[5] = "June";
        month[6] = "July";
        month[7] = "August";
        month[8] = "September";
        month[9] = "October";
        month[10] = "November";
        month[11] = "December";
    return month;
  },
  initDate: function(param) {
    var self = this;
    var initMonths = self.initMonths();
    var date = new Date(param);
    var month = initMonths[date.getMonth()];
    var year = date.getFullYear();
    var initEndDate = { month: month, year: year };
    return initEndDate;
  }
};

jQuery(document).ready(() => {
  jQuery.editProfile.init();
});
