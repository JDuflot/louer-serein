import Logo from '../../assets/logo/clean-house.png'
import React from "react"

function Footer() {
    return(
<>
        <div className="div-footer">
            <img src={Logo} alt="footer"/>
            <h2>© 2023 Louer Serein All rights reserved</h2>
        </div>
</>
    )
}
export default Footer