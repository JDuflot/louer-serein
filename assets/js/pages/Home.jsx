import React from 'react';
import Banner from '../components/Banner/Banner';
import Card from '../components/Card/Card';
import cards from '../Data/annonces.json'



function Home() {

    return(
<>
        {/* <Header/> placer sur AllRoutes*/}
        <Banner/>
        <Card cards={cards}/>

</>
    )
}
export default Home