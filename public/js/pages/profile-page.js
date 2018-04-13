jQuery.editProfile = {
  data: {
    portofolio: {
      id: ''
    },
    profile: {}
  },
  $endDateMonth: jQuery('#end-date-month'),
  $endDateYear: jQuery('#end-date-year'),
  $modalProfile: jQuery('#modal-profile'),
  $modalportofolio: jQuery('#modal-portofolio'),
  $modalDetPort: jQuery('#portofolio-details'),
  $body: jQuery('#profile'),
  $btnEditProfile: jQuery('#edit-profile'),
  $btnAddportofolio: jQuery('#add-portofolio'),
  $btnEditportofolio: jQuery('#edit-portofolio'),
  $btnShowportofolio: jQuery('.portofolios #show-portofolio'),
  $saveProfile: jQuery('#save-button-profile'),
  $closeProfile: jQuery('#close-modal'),
  $saveportofolio: jQuery('#save-button-portofolio'),
  $updateportofolio: jQuery('#update-button-portofolio'),
  $closeportofolio: jQuery('#close-portofolio-modal'),
  $closeDetPort: jQuery('#close-portofolio'),
  $body: jQuery('#profile'),
  init: function() {
    var self = this;
    jQuery('#skill-set').select2({
      tags: true
    });
    self.setEvent();
    self.profile();
    self.portofolio();
    self.showportofolioItem();
  },
  profile: function() {
    var self = this;
    self.$btnEditProfile.on('click', function() {
      self.$modalProfile.css({'display': 'block'});
      self.$body.css({'overflow': 'hidden'});
    });

    self.$closeProfile.on('click', function () {
      self.$modalProfile.css({'display': 'none'});
      self.$body.css({'overflow': 'auto'});
    });

    self.$saveProfile.on('click', function(){
      var object = {
        skill_set_name: jQuery('#skill-set').val()
      };
      var form = $('#profile-form').serializeArray();
      _.forEach(form, function(el, i){
        object[el.name] = el.value;
      });

      jQuery.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
      });
      jQuery.ajax({
        url: 'profile',
        type: 'PATCH',
        data: object,
        success: function(response) {
          window.location.reload();
          self.$modalProfile.css({'display': 'none'});
        }
      });
    });
  },
  portofolio: function() {
    var self = this;
    self.$btnAddportofolio.on('click', function() {
      self.$saveportofolio.show();
      self.$updateportofolio.hide();
      self.$modalportofolio.css({'display': 'block'});
      self.$body.css({'overflow': 'hidden'});
    });

    self.$closeportofolio.on('click', function () {
      jQuery('#portofolio-form')[0].reset();
      self.$modalportofolio.css({'display': 'none'});
      self.$body.css({'overflow': 'auto'});
    });

    self.$btnEditportofolio.on('click', function() {
      self.$saveportofolio.hide();
      self.$updateportofolio.show();
      self.$modalDetPort.css({'display': 'none'});
      self.$body.css({'overflow': 'auto'});
      async.waterfall([
        function(callback) {
          var id = self.data.portofolio.id;
          var url = 'portofolio/'+id;
          jQuery.get(url, function(response) {
            jQuery('#project-name').val(response.portofolio.project_name);
            jQuery('#project-url').val(response.portofolio.project_url);
            jQuery('#description').val(response.portofolio.description);
            if(response.portofolio.project_on_going == 1){
              jQuery('.project-ongoing #project-ongoing').prop('checked', true);
              jQuery('#start-date-month').val(response.start_date_month);
              jQuery('#start-date-year').val(response.start_date_year);
            } else {
              jQuery('.project-ongoing #project-ongoing').prop('checked', false);
              jQuery('#start-date-month').val(response.start_date_month);
              jQuery('#start-date-year').val(response.start_date_year);
              self.$endDateMonth.val(response.end_date_month);
              self.$endDateYear.val(response.end_date_year);
            }
            self.$modalportofolio.css({'display': 'block'});
            self.$body.css({'overflow': 'hidden'});
            callback(null, true);
          });
        }
      ]);
    });

    jQuery('.project-ongoing #project-ongoing').change(function(){
      if(this.checked){
        self.$endDateMonth.prop('disabled', 'disabled');
        self.$endDateYear.prop('disabled', 'disabled');
      } else {
        self.$endDateMonth.prop('disabled', false);
        self.$endDateYear.prop('disabled', false);
      }
    });

    self.$saveportofolio.on('click', function(event) {
      event.preventDefault();
      var url = 'portofolio';
      self.postPortofolio(url);
    });

    self.$updateportofolio.on('click', function(event){
      event.preventDefault();
      var url = 'portofolio/'+self.data.portofolio.id;
      self.postPortofolio(url);
    });
  },
  showportofolioItem: function() {
    var self = this;
    self.$btnShowportofolio.on('click', function() {
      self.data.portofolio.id = $(this).attr('data-portofolio-id');
      self.$modalDetPort.css({'display': 'block'});
      self.$body.css({'overflow': 'hidden'});
    });
    self.$closeDetPort.on('click', function () {
      self.$modalDetPort.css({'display': 'none'});
      self.$body.css({'overflow': 'auto'});
    });
  },
  setEvent: function() {
    var self = this;
    jQuery(window).click(function(event){
      if (event.target == self.$modalProfile) {
        self.$modalProfile.css({'display': 'none'});
        self.$body.css({'overflow': 'auto'});
      }
      if (event.target == self.$modalportofolio) {
        self.$modalportofolio.css({'display': 'none'});
        self.$body.css({'overflow': 'auto'});
        }
      if (event.target == self.$modalDetPort) {
        self.modalDetPort.css({'display': 'none'});
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

    jQuery.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    jQuery.ajax({
      url: url,
      data: formData,
      method: 'POST',
      contentType: false,
      processData: false,
      success: function(response) {
        window.location.reload();
        self.$modalportofolio.css({'display': 'none'});
        self.$body.css({'overflow': 'auto'});
      }
    });
  }
};

jQuery(document).ready(function(){
  jQuery.editProfile.init();
});
