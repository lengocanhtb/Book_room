<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->insert([
                [
                    "school"=> "Trường Đại học Công nghệ",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Trường Đại học Giáo dục",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Trường Đại học Khoa học Tự nhiên",
                    "address"=> "Quận Thanh Xuân",
                    "id_address"=> 9
                ],
                [
                    "school"=> "Trường Đại học Khoa học Xã hội và Nhân văn",
                    "address"=> "Quận Thanh Xuân",
                    "id_address"=> 9
                ],
                [
                    "school"=> "Trường Đại học Kinh tế",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Trường Đại học Ngoại ngữ",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Trường Đại học Việt - Nhật",
                    "address"=> "Quận Nam Từ Liêm",
                    "id_address"=> 13
                ],
                [
                    "school"=> "Trường Đại học Y Dược",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Trường Đại học Luật",
                    "address"=> "Quận Đống Đa",
                    "id_address"=> 6
                ],
                [
                    "school"=> "Đại học Bách khoa Hà Nội",
                    "address"=> "Quận Hai Bà Trưng",
                    "id_address"=> 7
                ],
                [
                    "school"=> "Đại học Công đoàn",
                    "address"=> "Quận Đống Đa",
                    "id_address"=> 6
                ],
                [
                    "school"=> "Đại học Công nghệ Giao thông Vận tải",
                    "address"=> "Quận Thanh Xuân",
                    "id_address"=> 9
                ],
                [
                    "school"=> "Đại học Tài nguyên và Môi trường Hà Nội",
                    "address"=> "Quận Bắc Từ Liêm",
                    "id_address"=> 15
                ],
                [
                    "school"=> "Đại học Công nghiệp Hà Nội",
                    "address"=> "Quận Bắc Từ Liêm",
                    "id_address"=> 15
                ],
                [
                    "school"=> "Đại học Công nghiệp Việt-Hung",
                    "address"=> "Thị xã Sơn Tây",
                    "id_address"=> 18
                ],
                [
                    "school"=> "Đại học Dược Hà Nội",
                    "address"=> "Quận Hoàn Kiếm",
                    "id_address"=> 2
                ],
                [
                    "school"=> "Đại học Điện lực",
                    "address"=> "Quận Bắc Từ Liêm",
                    "id_address"=> 15
                ],
                [
                    "school"=> "Đại học Khoa học và Công nghệ Hà Nội",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Đại học Kiểm sát Hà Nội",
                    "address"=> "Quận Hà Đông",
                    "id_address"=> 17
                ],
                [
                    "school"=> "Đại học Kiến trúc Hà Nội",
                    "address"=> "Quận Thanh Xuân",
                    "id_address"=> 9
                ],
                [
                    "school"=> "Đại học Kinh tế - Kỹ thuật Công nghiệp",
                    "address"=> "Quận Hai Bà Trưng",
                    "id_address"=> 7
                ],
                [
                    "school"=> "Đại học Kinh tế Quốc dân",
                    "address"=> "Quận Hai Bà Trưng",
                    "id_address"=> 7
                ],
                [
                    "school"=> "Đại học Lao động - Xã hội",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Đại học Lâm nghiệp Việt Nam",
                    "address"=> "Huyện Chương Mỹ",
                    "id_address"=> 25
                ],
                [
                    "school"=> "Đại học Mỏ - Địa chất",
                    "address"=> "Quận Bắc Từ Liêm",
                    "id_address"=> 15
                ],
                [
                    "school"=> "Đại học Mỹ thuật Công nghiệp",
                    "address"=> "Quận Đống Đa",
                    "id_address"=> 6
                ],
                [
                    "school"=> "Đại học Mỹ thuật Việt Nam",
                    "address"=> "Quận Hai Bà Trưng",
                    "id_address"=> 7
                ],
                [
                    "school"=> "Đại học Ngoại thương",
                    "address"=> "Quận Đống Đa",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Đại học Nội vụ",
                    "address"=> "Quận Tây Hồ",
                    "id_address"=> 3
                ],
                [
                    "school"=> "Đại học Sân khấu và Điện ảnh Hà Nội",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Đại học Sư phạm Hà Nội",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Đại học Sư phạm Nghệ thuật Trung ương",
                    "address"=> "Quận Thanh Xuân",
                    "id_address"=> 9
                ],
                [
                    "school"=> "Đại học Sư phạm Thể dục Thể thao Hà Nội",
                    "address"=> "Huyện Chương Mỹ",
                    "id_address"=> 15
                ],
                [
                    "school"=> "Đại học Thủy lợi",
                    "address"=> "Quận Đống Đa",
                    "id_address"=> 6
                ],
                [
                    "school"=> "Đại học Thương mại",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Đại học Văn hóa Hà Nội",
                    "address"=> "Quận Đống Đa",
                    "id_address"=> 6
                ],
                [
                    "school"=> "Đại học Xây dựng Hà Nội",
                    "address"=> "Quận Hai Bà Trưng",
                    "id_address"=> 7
                ],
                [
                    "school"=> "Đại học Y Hà Nội",
                    "address"=> "Quận Đống Đa",
                    "id_address"=> 6
                ],
                [
                    "school"=> "Đại học Y tế Công cộng",
                    "address"=> "Quận Bắc Từ Liêm",
                    "id_address"=> 15
                ],
                [
                    "school"=> "Đại học Thủ đô Hà Nội",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Đại học Công nghiệp Dệt may Hà Nội",
                    "address"=> "Huyện Gia Lâm",
                    "id_address"=> 12
                ],
                [
                    "school"=> "Đại học Mở Hà Nội",
                    "address"=> "Quận Hai Bà trưng",
                    "id_address"=> 7
                ],
                [
                    "school"=> "Đại học Văn hóa - Nghệ thuật Quân đội",
                    "address"=> "Quận Đống Đa",
                    "id_address"=> 6
                ],
                [
                    "school"=> "Đại học Phòng cháy chữa cháy",
                    "address"=> "Quận Thanh Xuân",
                    "id_address"=> 9
                ],
                [
                    "school"=> "Đại học Tài chính Ngân hàng",
                    "address"=> "Quận Bắc Từ Liêm",
                    "id_address"=> 15
                ],
                [
                    "school"=> "Đại học Thành Đô",
                    "address"=> "Huyện Hoài Đức",
                    "id_address"=> 22
                ],
                [
                    "school"=> "Đại học Phenikaa",
                    "address"=> "Quận Hà Đông",
                    "id_address"=> 17
                ],
                [
                    "school"=> "Đại học Thăng Long",
                    "address"=> "Quận Hoàng Mai",
                    "id_address"=> 8
                ],
                [
                    "school"=> "Đại học Phương Đông",
                    "address"=> "Quận Cầu Giấy",
                    "id_address"=> 5
                ],
                [
                    "school"=> "Đại học Quốc tế Bắc Hà",
                    "address"=> "Quận Thanh Xuân",
                    "id_address"=> 9
                ],
                [
                    "school"=> "Đại học Công nghệ Đông Á",
                    "address"=> "Quận Nam Từ Liêm",
                    "id_address"=> 13
                ],
                [
                    "school"=> "Đại học FPT",
                    "address"=> "Huyện Thạch Thất",
                    "id_address"=> 24
                ],
                [
                    "school"=> "Đại học Công nghệ và Quản lý Hữu nghị",
                    "address"=> "Quận Hoàng Mai",
                    "id_address"=> 8
                ],
                [
                    "school"=> "Đại học RMIT Việt Nam",
                    "address"=> "Quận Ba Đình",
                    "id_address"=> 1
                ],
                [
                    "school"=> "Đại học Nguyễn Trãi",
                    "address"=> "Quận Ba Đình",
                    "id_address"=> 1
                ],
                [
                    "school"=> "Đại học Hòa Bình",
                    "address"=> "Quận Nam Từ Liêm",
                    "id_address"=> 13
                ],
                [
                    "school"=> "Đại học Đại Nam",
                    "address"=> "Quận Hà Đông",
                    "id_address"=> 17
                ],
                [
                    "school"=> "Đại học Kinh doanh và Công nghệ",
                    "address"=> "Quận Hai Bà Trưng",
                    "id_address"=> 7
                ],
                [
                    "school"=> "Đại học Mỹ thuật Á Châu",
                    "address"=> "Quận Hai Bà Trưng",
                    "id_address"=> 7
                ],
                [
                    "school"=> "Đại học VinUni",
                    "address"=> "Huyện Gia Lâm",
                    "id_address"=> 1
                ]
            ]
        );
    }
}
