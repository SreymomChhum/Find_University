import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import 'vuetify/dist/vuetify.min.css'

import 'vuetify/styles'
import { createVuetify } from 'vuetify'

import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'


const vuetify = createVuetify({
  components,
  directives,
})


const app = createApp(App);
// Admin page (test)
import AddForm from './components/adminpage/AddForm.vue'
import SearchBar from './components/searchbar/SearchBar.vue'
import listUser from './components/adminpage/ListUser.vue'
app.component('add-form', AddForm);
app.component('search-bar', SearchBar);
app.component('list-user', listUser);

// HidedeLimiter
import HidedeLimiter from './components/hidedelimiters/HidedeLimiter.vue'

// apply form 
import Apply from './components/university/UniversityApplyForm.vue'
app.component('apply-form',Apply)

// side bar 
import SideBar from './components/navbars/SideBar.vue'
app.component("side-bar",SideBar)

// Navigation bar
import NavigationBar from './components/navbars/NavigationBar.vue'
import NavigationBarRight from './components/navbars/NavigationBarRight.vue'
import NavigationBarLink from './components/navbars/NavigationBarLink.vue'
import NavigationBarContent from './components/navbars/NavigationBarContent.vue'
app.component('navigation-bar', NavigationBar);
app.component('navigationbar-right', NavigationBarRight);
app.component('navigationbar-link', NavigationBarLink);
app.component('navigationbar-content',NavigationBarContent)

// contents
import contentList from './components/contents/ContentList.vue'
import scholarshipContent from './components/contents/ScholarshipWorkshopList.vue'
app.component('scholarship-workshop-card', scholarshipContent);
app.component('content-list', contentList);


// map
import mapShow from './components/Map/MapShow.vue'
app.component('map-show', mapShow);




// Include globaly all widgets
import BaseCard from './components/widgets/card/BaseCard.vue';
import CardInfo from './components/widgets/card/CardInfo.vue';
import CardContainer from './components/widgets/card/CardContainer.vue';
import CardItemDetail  from './components/widgets/card/CardDetail.vue';
import BaseButton from './components/widgets/button/BaseButton.vue';
import BaseDialog from './components/widgets/dialog/BaseDialog.vue';

// content title
import TitleView from './components/contents/ContentTitle.vue';
app.component('title-text', TitleView);

app.component('hidede-limiter', HidedeLimiter);

app.component('card-item', CardItemDetail);
app.component('base-card', BaseCard);
app.component('card-info', CardInfo);
app.component('card-container', CardContainer);
app.component('base-button', BaseButton);
app.component('base-dialog', BaseDialog);



// Footer bar
import FooterBar from './components/footer/FooterBar.vue'
import FooterIcon from './components/footer/FooterIcon.vue'
import FooterAvatar from './components/footer/FooterAvatar.vue'
import FooterDetails from './components/footer/FooterDetails.vue'
app.component('footer-bar', FooterBar);
app.component('footer-icon', FooterIcon);
app.component('footer-avatar', FooterAvatar);
app.component('footer-details', FooterDetails);




//About page
import AboutOurSchoolMission from '../src/components/about/OurSchool/OurSchoolMission.vue'
import AboutOurSchoolVision from '../src/components/about/OurSchool/OurSchoolVision.vue'
import AboutOurTeam from '../src/components/about/OurTeam/AboutOurTeam.vue'
import OurTeamMember from '../src/components/about/OurTeam/OurTeamMember.vue'
app.component('aboutmissionour-school', AboutOurSchoolMission);
app.component('aboutvisionour-school', AboutOurSchoolVision);
app.component('aboutour-team', AboutOurTeam);
app.component('ourteam-member', OurTeamMember);

//Contact page
import ContactBar from '../src/components/contact/ContactBar.vue'
app.component('contact-bar', ContactBar);

// university admin page 


// university admin scholarship page 
import ListScholarship from './components/scholarship/ListScholarship.vue'
import EditScholarship from './components/scholarship/EditScholarship.vue'
import AddScholarship from './components/scholarship/AddScholarship.vue'
app.component('list-scholarship', ListScholarship);
app.component('edit-scholarship', EditScholarship);
app.component('add-scholarship', AddScholarship);

// university admin workshop page 
import ListWorkshop from './components/workshop/ListWorkshop.vue'
import AddWorkshop from './components/workshop/AddWorkshop.vue'
import EditWorkshop from './components/workshop/EditWorkshop.vue'
app.component('list-workshop', ListWorkshop);
app.component('add-workshop', AddWorkshop);
app.component('edit-workshop', EditWorkshop);

// university admin major page 
import ListMajor from './components/major/ListMajor.vue'
import AddMajor from './components/major/AddMajor.vue'
app.component('list-major', ListMajor);
app.component('add-major', AddMajor);

// university admin view
import StudentRequest from './components/universitydirector/StudentRequest.vue'
app.component('student-request', StudentRequest);


// Register Workshop PopUP
import RegisterWorkshop from './components/workshop/RegisterAccountPopUp.vue'
app.component("register-account-popup",RegisterWorkshop)


router.beforeEach((to, from, next) => {
  const DEFAULT_TITLE = 'Find University'; // Set a default title for the website
  document.title = to.name ? to.name + ' - ' + DEFAULT_TITLE : DEFAULT_TITLE;
  next();
});

app.use(router);
app.use(vuetify);
app.mount('#app');

