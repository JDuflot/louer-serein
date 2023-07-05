import React from 'react';

function Loader() {
    return(
        <div className='d-flex justify-content-center align-items-center p-5'>
            <div className="spinner-border text-info" style={{width: '3rem', height: '3rem'}} role="status">
            </div>
        </div>
    )
}
export default Loader;