import chevronUp from '../../assets/icons/arrow-up.png'
import chevronDown from '../../assets/icons/arrow-down.png'
import { useState } from 'react';
import React from "react"

export default function Collapse({title, content}) {
    console.log(content);
    
    const [contentVisible, setContentVisible] = useState(true); // permet de dire que la valeur par défaut est false donc non visible
    
    const dispContent = () => {
        setContentVisible(!contentVisible)  } //inverse la valeur lors de l'event onClick
        
        const collapseContent = (contentVisible ? "visible" : "hidden ") + "coll"  // const condition ouverture du collapse
        const collapseChevron = (contentVisible ? chevronUp : chevronDown)  // const condition ouverture du chevron
        
        
        return (
            <>
        <div className='collapse-div'>
            <div className='collapse-all'>
                <div className='collapse-title' onClick={dispContent}>
                    <span>{title}</span>
                    <img className='chevronValue'
                        src={collapseChevron}
                        alt=""
                        />
                </div>
                <div className={collapseContent}>
                    <ul className='collapse-ul'>
                       {Array.isArray(content)
                       && content.map((item, index) => (
                           <li className='li-equipment' key={index}>{item}</li>
                           )) || content
                        }
                    </ul> 
                </div> 
            </div>
        </div>
        </>
    )
}
