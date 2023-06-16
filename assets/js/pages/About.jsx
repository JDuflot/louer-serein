import BannerAbout from '../components/Banner/BannerAbout';
import Accordion from '../components/Accordion/Accordion';
import categories from '../Data/categories.json';

function About() {
    return(
<>
    <BannerAbout/>
        <div className='accordions'>
        <Accordion categories={categories} title={categories.title} content={categories.description} />
    
        </div>
</>
    )
}
export default About