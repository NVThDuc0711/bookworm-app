import React from "react";
import "./style.scss"
import IMAGE from "../../../assets";
function Footer(){
    return (
        <div className="bookworm__footer" >
            <div className="bookworm__footer__text">
                <div className="row">
                    <div className="col-1">
                        <img src=".\images\book_icon.jpg" alt="book_icon" width={100} />
                    </div>
                    <div className="col-5">
                        <b>Bookworm | Shop Book</b>
                        <br />
                        <b>Address : 20 Giang Cự Vọng , phường Trung Mỹ Tây , quận 12 , TP. Hồ Chí Minh</b>
                        <br />
                        <b>Phone : 0986746450</b>
                        <br />
                        <b>Design by <a href="https://www.facebook.com/profile.php?id=100031891651861">Nguyễn Đức</a></b>
                    </div>
                </div>
                
            </div>
        </div>
    );
}

export default Footer;