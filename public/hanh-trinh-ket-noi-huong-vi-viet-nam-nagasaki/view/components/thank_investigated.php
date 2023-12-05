<div class="tab-contents">
    <div class="thanks-page" id="thanks">
        <div class="thanks-content">
            <h2>
                Cảm ơn bạn đã tham gia khảo sát cùng chương trình <br>“Hành trình kết nối hương vị Việt Nam - Nagasaki”
                <?php 
                if(!empty($customer['created_at'])) {
                    echo ' vào ngày ' . date('d-m-Y', strtotime($customer['created_at']));
                } ?>
            </h2>
            <div class="gift-content">
                <p class="gift-title">
                    MÃ DỰ THƯỞNG CỦA BẠN LÀ
                </p>
                <h3 class="gift-code">
                    <?php echo $customer['code']; ?>
                </h3>
                <p>
                    Với mỗi bài khảo sát được gửi thành công, bạn sẽ có mã tham gia chương trình trúng thưởng. Giải thưởng sẽ được công bố tại fanpage <a href="<?php echo $linkFacbook; ?>" target="_blank" rel="nofollow noopener" title="Hành Trình Kết Nối Hương Vị Việt Nam - Nagasaki">Hành Trình Kết Nối Hương Vị Việt Nam - Nagasaki 
                    </a>, chúng tôi sẽ liên hệ người trúng giải qua email và số điện thoại đã cung cấp trong bài khảo sát.
                </p>
            </div>
        </div>
    </div>
</div>