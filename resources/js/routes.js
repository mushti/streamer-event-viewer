import VueRouter from 'vue-router';
import TwitchLogin from './components/TwitchLogin';
import StreamViewer from './components/StreamViewer';

window.routePrefix = '';
if (window.location.pathname.startsWith('/streamereventviewer')) {
	window.routePrefix = '/streamereventviewer/public';
}

let routes = [
	{
		name: 'login',
		path: routePrefix + '/login',
		component: TwitchLogin
	},
	{
		name: 'stream',
		path: routePrefix + '/',
		component: StreamViewer
	}
]

export default new VueRouter({
	routes,
	mode: 'history',
	linkActiveClass: 'active'
})