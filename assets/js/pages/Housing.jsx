import React from "react"
import Carrousel from "../components/Carrousel/Carrousel"
import Sheet from "../components/Appartment/Sheet"
import datas from "../Data/annonces.json"
import { useParams } from "react-router-dom"
import { Link } from "react-router-dom"



function Housing() {
    // console.log(datas);
    const { housingId } = useParams(); //va chercher dans le routing housingId
    const data = datas.find(element => element.id === housingId) // const qui permet d'aller chercher un élément dans les datas json et recherche uniquement par l'id


    return(

 <>
    <div className="carrousel">
    <Carrousel pictures={data.pictures}/> 
    {/* appel la const data et précise ce que l'on veut comme données du json, ici les images du carrousel, toujours via la recherche ID */}
    </div>
    <div className="housing-all">
    <div className="housing-up">
        <a><Link className="btn btn-chat" reloadDocument={true} to="/chat">Messagerie</Link></a>
        <Sheet hosts={data.host} ratings={data.rating} descriptions={data.description} equipments = {data.equipments} titles={data.title} locations ={data.location} tags={data.tags}/>
        {/* faire ça pour chaque E du tableau datas puis les appeler dans la page Sheet un par un */}
    </div>

    </div> 
 </>
    ) 
}
export default Housing