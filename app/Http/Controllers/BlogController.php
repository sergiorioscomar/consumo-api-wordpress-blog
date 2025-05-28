public function getBlogPosts()
{
    $url = 'https://[URL_DE_TU_BLOG]/wp-json/wp/v2/posts?per_page=3';
    $posts = $this->makeCurlRequest($url);

    if (!$posts) return view('index', ['publicaciones' => []]);

    $postsWithImages = [];

    foreach ($posts as $post) {
        $featuredMediaId = $post['featured_media'];
        if ($featuredMediaId) {
            $mediaUrl = "https://[URL_DE_TU_BLOG]/wp-json/wp/v2/media/$featuredMediaId";
            $mediaDetails = $this->makeCurlRequest($mediaUrl);
            $post['featured_image_url'] = $mediaDetails['media_details']['sizes']['full']['source_url'] ?? null;
        } else {
            $post['featured_image_url'] = null;
        }
        $postsWithImages[] = $post;
    }

    return view('index', ['publicaciones' => $postsWithImages]);
}


private function makeCurlRequest($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close($ch);
        return false;
    }
    curl_close($ch);
    return json_decode($response, true);
}
