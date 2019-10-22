/*jslint browser: true, devel: true*/
/*global Typekit*/
"use strict";
try {
  Typekit.load();
  var typekit = document.querySelector('link[href^="http://use.typekit.net"]');
  typekit.setAttribute('data-noprefix', 'true');
} catch (e) {
  console.log(e);
}