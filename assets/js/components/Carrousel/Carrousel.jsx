import React from 'react'
import { useState } from 'react'
import {FaArrowAltCircleRight, FaArrowAltCircleLeft } from 'react-icons/fa'


function Carrousel (props)  {
    const [current, setCurrent] = useState(0)
    const length = props.pictures.length;

    const nextSlide = () => {
        setCurrent(current === length -1 ? 0 : current + 1)
    }
    const prevSlide = () => {
        setCurrent(current === 0 ? length - 1 : current - 1);
      };
    
    if(!Array.isArray(props.pictures) || length <= 0){
        return null;
    }
        return (
 <>
  <section className='slider'>
    <FaArrowAltCircleLeft className='left-arrow' onClick={prevSlide} />
    <FaArrowAltCircleRight className='right-arrow' onClick={nextSlide} />

   {props.pictures.map((data, index) => {
    return (
        <div className={index === current ? 'slide active' : 'slide'}
        key={index}
        >
            {index === current &&(
            <img className='image' src={data} alt=""/>
            )}
            <p className='slideCount'>{current+1} / {length}</p>
        </div>
    )
})}
  </section>
   </>
  )
}
export default Carrousel

