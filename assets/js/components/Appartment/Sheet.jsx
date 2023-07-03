import React from 'react'
// import { useEffect, useState } from 'react';
// import { useParams } from 'react-router-dom';
// import datas from '../../Data/annonces.json';
import goldStar from '../../assets/icons/goldstar.png';
import greyStar from '../../assets/icons/grey_star.png';
import Collapse from '../Collapse/Collapse';

function Sheet(props) {

    const rating = props.ratings; //ratings ayant deux objets création d'une const
  return (
    <div>
        <div className='housing'>

                <div>
				{/* appel les props puis reprend la déclaration dans Housing pour récupérer les bonnes datas pour chaque E*/}
                <h1  className='housing-title'>{props.titles}</h1>  
						    <p className='housing-loc'>{props.locations}</p>
                <div>
							{props.tags.map((element, index) => {
								return (
									<button className='housing-btn' key={index}>{element}</button>
								)
							})}
						</div>
					</div>
					<div className="host">
						<div className='host-name-img'>
							<div className='div-host'>
								<span className='host-name'> {props.hosts.name}</span>
								<span><img className='host-img' src={props.hosts.picture} alt="host of this accomodation" /></span>
							</div>

					</div>

						<div className="host-stars">
							{[...Array(5)].map((star, index) => {
								const ratingValue = index + 1;
								return (
									<img className='host-star' key={index} src={ratingValue <= rating ? goldStar : greyStar} alt="star" />
								)
							})}
						</div>
					</div>
				</div>
        <div className='collapse-main'>
			{/* appel le component Collapse, titre sert à afficher, content permet de donner la data correspondante */}
					<div  className='collapse-description'>
						<Collapse  title={'Description'} content={props.descriptions} />
					</div>
					<div className='collapse-equipment' >
						<Collapse  title={'Equipements'} content={props.equipments}/>
					</div>
				</div>
        </div>


  )
}

export default Sheet

