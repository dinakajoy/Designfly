/**
 * Main scripts, loaded on all pages.
 *
 * @package designfly
 */

import '../sass/main.scss';
import * as components from './components';

window.$ = window.$ || jQuery;

// Initialize common scripts.
components.WebFont.init();
components.common.init();
components.siteMenu.init();

/*
  * Scripts for the portfolio modal
*/
const portfolioItems = document.querySelectorAll( '.portfolio__text' );
const modalImg = document.getElementById( 'img01' );
const modal = document.getElementById( 'myModal' );

// Get the <span> element that closes the modal
const span = document.getElementsByClassName( 'close' )[0];

for ( let item = 0; item < portfolioItems.length; item++ ) {
	portfolioItems[item].addEventListener( 'click', ( e ) => {
		let img = e.target.parentElement.parentElement.parentElement.firstElementChild;
		modal.style.display = 'block';
		modalImg.src = img.src;
	} );
};

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
	modal.style.display = 'none';
};

/*
  * Scripts for the slider on the homepage
*/
let slideIndex = 1;
showSlides( slideIndex );

function showSlides( currentSlide ) {
	let i;
	let slides = document.getElementsByClassName( 'slider__content' );

	if ( currentSlide > slides.length ) {
		slideIndex = 1;
	}
	if ( 1 > currentSlide ) {
		slideIndex = slides.length;
	}
	for ( i = 0; i < slides.length; i++ ) {
		slides[i].style.display = 'none';
	}
	slides[slideIndex - 1].style.display = 'block';
}

function plusSlides( n ) {
	showSlides( slideIndex += n );
}

const next = document.getElementById( 'next' );
const previous = document.getElementById( 'prev' );

next.addEventListener( 'click', () => plusSlides( 1 ), true );
previous.addEventListener( 'click', () => plusSlides( -1 ), true );
