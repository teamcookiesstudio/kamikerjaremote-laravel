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
    var url = jQuery('#portofolio-show').val();
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

    jQuery('#file-avatar').change( function() {
      self.initChangeProfilePicture(this, $('#profile-image'));
    });

    var _URL = window.URL || window.webkitURL;
    jQuery('#file-cover').on('change', function() {
      var file = $(this)[0].files[0];
      reader = new FileReader();
      reader.readAsDataURL( file );
      reader.onload = function(){
        img = new Image();
        var imgwidth = 0;
        var imgheight = 0;
        var maxwidth = 1200;
        var maxheight = 200;

        img.src = _URL.createObjectURL(file);
        img.onload = function(e) {
          
          imgwidth = this.width;
          if(imgwidth < maxwidth && imgheight < maxheight){
            $.notify('Image width and height should be 1200x200 or more..');
          } else {
            jQuery('.profile-header').css('background', 'url('+reader.result+')');
          }
        }
      }
    });

    self.wrapper.profile.$btnEditProfile.click( function() {
      self.wrapper.profile.$modalProfile.css({'display': 'block'});
      self.$body.css({'overflow': 'hidden'});
    });

    self.wrapper.profile.$closeProfile.click( function() {
      self.wrapper.profile.$modalProfile.css({'display': 'none'});
      self.$body.css({'overflow': 'auto'});
    });

    self.wrapper.profile.$saveProfile.click( function() {
      var form = $('#profile-form').serializeArray();
      var skillSet = self.wrapper.profile.$skillSet.val();
      var object = new FormData();
      if (_.isNull(skillSet)) {
        $.notify('Atleast 1 skill must be set..');
      }
      for (var i = 0; i < skillSet.length; i++){
        object.append('skill_set_name[]', skillSet[i]);
      }
      object.append('image_header', jQuery('#file-cover').prop('files')[0])
      object.append('url_photo_profile', jQuery('#file-avatar').prop('files')[0]);
      object.append('_method', 'patch');  
      _.forEach(form, function(el, i){
        object.append(el.name, el.value);
      });
      
      jQuery.ajax({
        url: jQuery('#save-profile-post').val(),
        type: 'POST',
        data: object,
        cache: false,
        contentType: false,
        processData: false,
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
        self.wrapper.portofolio.$startDateMonth.val(initStartDate.idMonth+1);
        self.wrapper.portofolio.$startDateYear.val(initStartDate.year);
        self.wrapper.portofolio.$endDateMonth.addClass('disabled').prop('disabled', true);
        self.wrapper.portofolio.$endDateYear.addClass('disabled').prop('disabled', true);
      } else {
        self.wrapper.portofolio.$btnProjectOnGoing.prop('checked', false);
        self.wrapper.portofolio.$startDateMonth.val(initStartDate.idMonth+1);
        self.wrapper.portofolio.$startDateYear.val(initStartDate.year);
        self.wrapper.portofolio.$endDateMonth.val(initEndDate.idMonth+1);
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
      var url = jQuery('#save-portofolio-post').val();
      self.postPortofolio(url);
    });

    self.wrapper.portofolio.$updateportofolio.click(function(event) {
      event.preventDefault();
      var url = 'portofolios/'+self.data.portofolio.id;
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
      console.log(data, initStartDate);

      jQuery('#portofolio-item-project-name').text(data.project_name);
      jQuery('#portofolio-item-description').text(data.description);
      jQuery('#portofolio-item-image').attr('src', '/storage/portofolio/'+data.thumbnail);
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
      project_on_going: 0
    };

    if(jQuery('.project-ongoing #project-ongoing').is(':checked')){
      object.project_on_going = 1;
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
    var idMonth = date.getMonth();
    var year = date.getFullYear();
    var initEndDate = { month: month, year: year, idMonth: idMonth };
    return initEndDate;
  },
  initChangeProfilePicture: function(input, $selector) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function(e) {
        $selector.attr('src', e.target.result);
      }
  
      reader.readAsDataURL(input.files[0]);
    }
  }
};

jQuery(document).ready( function() {
  jQuery.editProfile.init();
});
