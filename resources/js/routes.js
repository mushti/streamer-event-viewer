import VueRouter from 'vue-router';
import TwitchLogin from './components/TwitchLogin';
import StreamViewer from './components/StreamViewer';

let routes = [
	{
		name: 'login',
		path: '/login',
		component: TwitchLogin
	},
	{
		name: 'stream',
		path: '/',
		component: StreamViewer
	}
]

export default new VueRouter({
	routes,
	mode: 'history',
	linkActiveClass: 'active'
})