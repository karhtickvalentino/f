$(function(){

  STEP_OPTIONS = {
    one: 1,
    two: 2
  };

  STEPS = [{
    content: 'click on register to register new account',
    highlightTarget: true,
    //nextButton: true,
    target: $('#reg'),
    my: 'top center',
    at: 'bottom center',
     bind: ['onClick'],
    setup: function(tour, options) {
      $('#reg').on('click', this.onClick);
    },
    teardown: function(tour, options) {
      $('#reg').off('click', this.onClick);
    },
    onClick: function(tour){
      tour.next();
      return false;
    }
  },
  {
    content: 'select user type',
    highlightTarget: true,
    target: $('#regtype'),
    my: 'top center',
    at: 'bottom center',
    bind: ['onClick'],
    setup: function(tour, options) {
      $('#regtype').on('click', this.onClick);
    },
    teardown: function(tour, options) {
      $('#regtype').off('click', this.onClick);
    },
    onClick: function(tour){
      tour.next();
      return false;
    }
  },{
    content: '<p>enter name</p>',
    target: $('#regname'),
    my: 'top left',
    nextButton:true,
    bind: ['onChangeSomething'],
     setup: function(tour, options) {
      $('#regname').on('click', this.onChangeSomething);
    },
    teardown: function(tour, options) {
      $('#regname').off('click', this.onChangeSomething);
    },
    onChangeSomething: function(tour){
      tour.next();
      return false;
    }
  },{
    content: '<p>enter email</p>',
    target: $('#regemail'),
    my: 'top left',
    nextButton:true,
    bind: ['onChangeSomething'],
     setup: function(tour, options) {
      $('#regemail').on('click', this.onChangeSomething);
    },
    teardown: function(tour, options) {
      $('#regemail').off('click', this.onChangeSomething);
    },
    onChangeSomething: function(tour){
      tour.next();
      return false;
    }
  }]


  FINAL = {
    content: '<p>Final Step</p>',
    highlightTarget: true,
    nextButton: true,
    target: $('#main-heading'),
    my: 'top center',
    at: 'bottom center'
  }

  TOUR = new Tourist.Tour({
    stepOptions: STEP_OPTIONS,
    steps: STEPS,
    successStep: FINAL,
    tipOptions:{
      showEffect: 'slidein'
    }
  });
  TOUR.start();

  });