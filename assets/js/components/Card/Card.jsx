import { Link } from 'react-router-dom';
import React from "react"
// import Housing from '../../pages/Housing';


function Card(props) {
    console.log(props.cards);
    return (
      <>
        <div className="card-bg">
          {props.cards.map((card) => (
              <div className="card" key={card.id}>
                <Link key={`housing-${card.id}`} to={`/housing/${card.id}`}>
                <img className="card-img" src={card.cover} alt="location" />
                <p className="card-title">{card.title}</p>
                <div className='card-title-bg'></div>
                </Link>
            </div>
          ))}
        </div>
      </>
    );
  }

export default Card
