/*jshint laxcomma: true, smarttabs: true*/
/*
  Author: Hugh Guiney
*/

$('.js-fb-share').on('click', function fbShare( event ) {
  var $button = $(this);

  window.open($button.attr('href'), 'facebook-share-dialog', 'width=626,height=436');

  return false;
});

$('.js-tweet').on('click', function tweet( event ) {
  var $button = $(this);

  window.open($button.attr('href'), 'twitter-share-dialog', 'width=550,height=390');

  return false;
});

$('.js-google-plus').on('click', function googlePlusShare( event ) {
  var $button = $(this);

  //console.log(event.data.selector);

  window.open($button.attr('href'), 'google-share-dialog', 'width=500,height=600');

  return false;
});