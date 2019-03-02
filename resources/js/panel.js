// Import bootstrap.
import './bootstrap';
import router from './routes';
import user from './stores/user';
import Navbar from './components/Navbar';

var panel = new Vue({

	store: user,

    el: '#panel',

	components: {
		Navbar
	},

    beforeMount() {
        if (!this.$store.state.user) {
            this.$router.push({ name: 'login' });
        }
    },

    router

});
