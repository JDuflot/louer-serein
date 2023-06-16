import React from "react";
import { useState } from "react";
import arrow from '../../assets/icons/arrow.png'

function Accordion(props) {

    const [active, setActive] = useState([]); // const qui permet d'utiliser la valeur de la contante sous forme de tableau

    const handleToggle =(index)=>{                  //const pour l'ouverture du toggle
       const currentIndex = active.indexOf(index);
       const newActiveIndex = [...active];  // copie le tableau active
       if(currentIndex === -1){            // si l'index est strictement égal à -1 alors ajoute(push) dans le tableau newActive unn nouvel élément sinon (splice) modifie le tableau
        newActiveIndex.push(index);
           }else{
            newActiveIndex.splice(currentIndex,1);
        }
        setActive(newActiveIndex);
        };


    return(
<>
        <div className="accordion-container">
        {props.categories.map((cat,index) => (  // recupère les props de la function cible dans les datas et avec map affiche le composant voulu avec des paramètres
        <div key={index}
        className={`accordion ${active.includes(index) && "active"}`}
        >

            <div className="accordion-title" onClick={()=>handleToggle(index)}>
                {cat.title} <img className={active ? 'arrow arrow_up' : 'arrow arrow_down'} src={arrow} alt=""></img>
                </div>
            <div className="accordion-content">{cat.description}</div>
        </div>
         ))}
        </div>

</>

    )
}

export default Accordion;