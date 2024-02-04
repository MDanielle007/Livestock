import '@/assets/styles/style.scss'
// import '@/assets/styles/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import PrimeVue from 'primevue/config'
import AutoComplete from 'primevue/autocomplete'
import Accordion from 'primevue/accordion'
import AccordionTab from 'primevue/accordiontab'
import Avatar from 'primevue/avatar'
import AvatarGroup from 'primevue/avatargroup'
import Badge from 'primevue/badge'
import BadgeDirective from 'primevue/badgedirective'
import Button from 'primevue/button'
import Calendar from 'primevue/calendar'
import Card from 'primevue/card'
import Chart from 'primevue/chart'
import Checkbox from 'primevue/checkbox'
import Chip from 'primevue/chip'
import Chips from 'primevue/chips'
import Column from 'primevue/column'
import ColumnGroup from 'primevue/columngroup'
import ConfirmDialog from 'primevue/confirmdialog'
import ConfirmPopup from 'primevue/confirmpopup'
import ConfirmationService from 'primevue/confirmationservice'
import ContextMenu from 'primevue/contextmenu'
import DataTable from 'primevue/datatable'
import DataView from 'primevue/dataview'
import DataViewLayoutOptions from 'primevue/dataviewlayoutoptions' 
import DeferredContent from 'primevue/deferredcontent'
import DialogService from 'primevue/dialogservice'
import Divider from 'primevue/divider'
import Dock from 'primevue/dock'
import Dropdown from 'primevue/dropdown'
import DynamicDialog from 'primevue/dynamicdialog'
import Fieldset from 'primevue/fieldset'
import FileUpload from 'primevue/fileupload'
import Galleria from 'primevue/galleria'
import Image from 'primevue/image'
import InlineMessage from 'primevue/inlinemessage'
import Inplace from 'primevue/inplace'
import InputSwitch from 'primevue/inputswitch'
import InputText from 'primevue/inputtext'
import InputMask from 'primevue/inputmask'
import InputNumber from 'primevue/inputnumber'
import InputGroup from 'primevue/inputgroup'
import InputGroupAddon from 'primevue/inputgroupaddon'
import Listbox from 'primevue/listbox'
import MegaMenu from 'primevue/megamenu'
import Menu from 'primevue/menu'
import Menubar from 'primevue/menubar'
import MultiSelect from 'primevue/multiselect'
import OrderList from 'primevue/orderlist'
import Paginator from 'primevue/paginator'
import Panel from 'primevue/panel'
import Password from 'primevue/password'
import PickList from 'primevue/picklist'
import ProgressBar from 'primevue/progressbar'
import ProgressSpinner from 'primevue/progressspinner'
import RadioButton from 'primevue/radiobutton'
import Ripple from 'primevue/ripple'
import Row from 'primevue/row'
import SelectButton from 'primevue/selectbutton'
import ScrollPanel from 'primevue/scrollpanel'
import Sidebar from 'primevue/sidebar'
import Slider from 'primevue/slider'
import SplitButton from 'primevue/splitbutton'
import Steps from 'primevue/steps'
import StyleClass from 'primevue/styleclass'
import TabMenu from 'primevue/tabmenu'
import TieredMenu from 'primevue/tieredmenu'
import Textarea from 'primevue/textarea'
import Toast from 'primevue/toast'
import ToastService from 'primevue/toastservice'
import Toolbar from 'primevue/toolbar'
import TabView from 'primevue/tabview'
import TabPanel from 'primevue/tabpanel'
import Tag from 'primevue/tag'
import Timeline from 'primevue/timeline'
import ToggleButton from 'primevue/togglebutton'
import Tooltip from 'primevue/tooltip'
import Tree from 'primevue/tree'
import TreeTable from 'primevue/treetable'
import TriStateCheckbox from 'primevue/tristatecheckbox'
import VirtualScroller from 'primevue/virtualscroller'
import 'primevue/resources/themes/lara-light-blue/theme.css'

import axios from 'axios'

axios.defaults.baseURL = import.meta.env.VITE_APP_API_BASE_URL

const app = createApp(App)

app.use(router)
app.use(PrimeVue, { 
    ripple: true,
})
app.use(ToastService)
app.use(DialogService)
app.use(ConfirmationService)
app.use(store)

app.directive('tooltip', Tooltip)
app.directive('badge', BadgeDirective)
app.directive('ripple', Ripple)
app.directive('styleclass', StyleClass)

app.component('AutoComplete',AutoComplete)
app.component('Accordion', Accordion)
app.component('AccordionTab', AccordionTab)
app.component('Avatar', Avatar)
app.component('AvatarGroup', AvatarGroup)
app.component('Badge', Badge)
app.component('Button', Button)
app.component('Calendar', Calendar)
app.component('Card', Card)
app.component('Chart', Chart)
app.component('Checkbox', Checkbox)
app.component('Chip', Chip)
app.component('Chips', Chips)
app.component('Column', Column)
app.component('ColumnGroup', ColumnGroup)
app.component('ConfirmDialog', ConfirmDialog)
app.component('ConfirmPopup', ConfirmPopup)
app.component('ContextMenu', ContextMenu)
app.component('DataTable', DataTable)
app.component('DataView', DataView)
app.component('DataViewLayoutOptions', DataViewLayoutOptions)
app.component('DeferredContent', DeferredContent)
app.component('Divider', Divider)
app.component('Dock', Dock)
app.component('Dropdown', Dropdown)
app.component('DynamicDialog', DynamicDialog)
app.component('Fieldset', Fieldset)
app.component('FileUpload', FileUpload)
app.component('Galleria', Galleria)
app.component('Image', Image)
app.component('InlineMessage', InlineMessage)
app.component('Inplace', Inplace)
app.component('InputSwitch', InputSwitch)
app.component('InputText', InputText)
app.component('InputMask', InputMask)
app.component('InputNumber', InputNumber)
app.component('InputGroup', InputGroup)
app.component('InputGroupAddon', InputGroupAddon)
app.component('Listbox', Listbox)
app.component('MegaMenu', MegaMenu)
app.component('Menu', Menu)
app.component('Menubar', Menubar)
app.component('MultiSelect', MultiSelect)
app.component('OrderList', OrderList)
app.component('Paginator', Paginator)
app.component('Panel', Panel)
app.component('Password', Password)
app.component('PickList', PickList)
app.component('ProgressBar', ProgressBar)
app.component('ProgressSpinner', ProgressSpinner)
app.component('RadioButton', RadioButton)
app.component('Row', Row)
app.component('SelectButton', SelectButton)
app.component('ScrollPanel', ScrollPanel)
app.component('Sidebar', Sidebar)
app.component('Slider', Slider)
app.component('SplitButton', SplitButton)
app.component('Steps', Steps)
app.component('TabMenu', TabMenu)
app.component('TieredMenu', TieredMenu)
app.component('Textarea', Textarea)
app.component('Toast', Toast)
app.component('Toolbar', Toolbar)
app.component('TabView', TabView)
app.component('TabPanel', TabPanel)
app.component('Tag', Tag)
app.component('Timeline', Timeline)
app.component('ToggleButton', ToggleButton)
app.component('Tree', Tree)
app.component('TreeTable', TreeTable)
app.component('TriStateCheckbox', TriStateCheckbox)
app.component('VirtualScroller', VirtualScroller)

app.mount('#app')
