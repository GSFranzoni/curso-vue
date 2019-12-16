<template>
	<v-app>
		<app-menu></app-menu>
		<app-toolbar></app-toolbar>
		<app-slider></app-slider>
		<app-footer></app-footer>
	</v-app>
</template>

<script>

import AppToolbar from './components/AppToolbar';
import Slider from './components/Slider';
import Footer from './components/Footer';
import Menu from './components/Menu';

export default {
	components: {
		'app-toolbar': AppToolbar,
		'app-slider': Slider,
		'app-footer': Footer,
		'app-menu': Menu
	}
}
</script>
