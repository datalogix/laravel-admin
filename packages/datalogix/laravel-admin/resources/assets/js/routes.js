import UserAccount from './pages/Resource/Edit.vue'
import UserSettings from './pages/Resource/Edit.vue'
import Dashboard from './pages/Dashboard.vue'
import Resource from './pages/Resource.vue'
import ResourceIndex from './pages/Resource/Index.vue'
import ResourceCreate from './pages/Resource/Create.vue'
import ResourceEdit from './pages/Resource/Edit.vue'

const routes = [
    { path: '/', component: Dashboard, name: 'dashboard' },
    { path: '/user/account', component: UserAccount, name: 'user-account' },
    { path: '/user/settings', component: UserSettings, name: 'user-settings' },
    {
        path: '/resource/:resourceName', component: Resource,
        children: [
            { path: 'create', component: ResourceCreate, name: 'resource-create' },
            { path: 'edit', component: ResourceEdit, name: 'resource-edit' },
            { path: '', component: ResourceIndex, name: 'resource', alias: '*' },
        ]
    },
    { path: '*', redirect: { name: 'dashboard' } }
]

export default routes
