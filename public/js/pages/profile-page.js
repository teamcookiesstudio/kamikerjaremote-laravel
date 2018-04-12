jQuery.editProfile = {
  $modalProfile: jQuery('#modal-profile'),
  $modalportofolio: jQuery('#modal-portofolio'),
  $modalDetPort: jQuery('#portofolio-details'),
  $body: jQuery('#profile'),
  $btnEditProfile: jQuery('#edit-profile'),
  $btnEditportofolio: jQuery('#edit-portofolio'),
  $btnShowportofolio: jQuery('.portofolios #show-portofolio'),
  $saveProfile: jQuery('#save-button-profile'),
  $closeProfile: jQuery('#close-modal'),
  $saveportofolio: jQuery('#save-button-portofolio'),
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
    self.$btnEditportofolio.on('click', function() {
      self.$modalportofolio.css({'display': 'block'});
      self.$body.css({'overflow': 'hidden'});
    });

    self.$closeportofolio.on('click', function () {
      self.$modalportofolio.css({'display': 'none'});
      self.$body.css({'overflow': 'auto'});
    });

    jQuery('.project-ongoing #project-ongoing').change(function(){
      if(this.checked){
        jQuery('#end-date-month').prop('disabled', 'disabled');
        jQuery('#end-date-year').prop('disabled', 'disabled');
      } else {
        jQuery('#end-date-month').prop('disabled', false);
        jQuery('#end-date-year').prop('disabled', false);
      }
    });

    self.$saveportofolio.on('click', function() {
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
        url: 'portofolio',
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(response) {
          window.location.reload();
          self.$modalportofolio.css({'display': 'none'});
          self.$body.css({'overflow': 'auto'});
        }
      });
    });
  },
  showportofolioItem: function() {
    var self = this;
    self.$btnShowportofolio.on('click', function() {
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
  }
};

jQuery(document).ready(function(){
  jQuery.editProfile.init();
});
