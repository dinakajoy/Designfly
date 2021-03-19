/**
 * Header Menu JS.
 *
 * @type {Object}
 */
const siteMenu = {

	/**
	 * Initialize.
	 *
	 * @return {void}
	 */
	init() {

		this.menuOpenbtn = document.getElementById( 'menu-open' );
		this.menuClosebtn = document.getElementById( 'closebtn' );

		this.addEvents();

	},

	/**
	 * Add events.
	 *
	 * @return {void}
	 */
	addEvents() {

		if ( null !== this.menuButton ) {

			this.menuOpenbtn.addEventListener( 'click', () => this.openNav() );
			this.menuClosebtn.addEventListener( 'click', () => this.closeNav() );

		}

	},

	/**
	 * Open navigation on mobile.
	 *
	 * @return {void}
	 */
	openNav() {
		document.getElementById( 'myNav' ).style.width = '100%';
	},

	/**
	 * Close navigation on mobile.
	 *
	 * @return {void}
	 */
	closeNav() {
		document.getElementById( 'myNav' ).style.width = '0%';
	}
};

export default siteMenu;
